<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Exception;

class BackupController extends Controller
{
    public function index()
    {
        $disk = Storage::disk('local');  // Use 'local' disk for storage
        $files = $disk->files('backups');  // Look for files in the 'backups' directory
        $now = Carbon::now();
        $backups = [];

        foreach ($files as $f) {
            if (substr($f, -4) == '.sql' && $disk->exists($f)) {
                $lastModifiedDate = Carbon::createFromTimestamp($disk->lastModified($f));
                $fileAge = $lastModifiedDate->diffForHumans($now, true);

                $backups[] = [
                    'file_path' => $f,
                    'file_name' => basename($f),
                    'file_size' => $this->formatFileSize($disk->size($f)),
                    'file_age' => $fileAge,
                    'last_modified' => $lastModifiedDate->format('Y-m-d')
                ];
            }
        }

        $backups = array_reverse($backups);

        return view('Backup.index', compact('backups'));
    }

    public function backup()
    {
        try {
            $filename = 'backup_' . date('Y_m_d_His') . '.sql';
            $path = storage_path("app/backups/{$filename}");

            $tables = DB::select('SHOW TABLES');
            $dbName = env('DB_DATABASE');
            $sqlDump = "SET FOREIGN_KEY_CHECKS=0;\n\n";

            foreach ($tables as $table) {
                $tableName = array_values((array) $table)[0];

                $sqlDump .= "DROP TABLE IF EXISTS `{$tableName}`;\n";

                // Get CREATE TABLE statement
                $createTable = DB::select("SHOW CREATE TABLE `{$tableName}`");
                $sqlDump .= $createTable[0]->{'Create Table'} . ";\n\n";

                // Get INSERT statements
                $rows = DB::table($tableName)->get();
                if (count($rows)) {
                    foreach ($rows as $row) {
                        $rowData = array_map(fn($value) => is_null($value) ? 'NULL' : DB::connection()->getPdo()->quote($value), (array) $row);
                        $sqlDump .= "INSERT INTO `{$tableName}` VALUES (" . implode(',', $rowData) . ");\n";
                    }
                    $sqlDump .= "\n";
                }
            }

            $sqlDump .= "SET FOREIGN_KEY_CHECKS=1;\n";

            // Save the dump to a file
            $filePut = file_put_contents($path, $sqlDump);
            $test = Storage::disk('backups')->put($filename, file_get_contents($path));
            // unlink($path);

            return back()->with('success', 'Database backup created successfully!');
        } catch (\Exception $e) {
            return back()->withErrors('Error: ' . $e->getMessage());
        }
    }

    // Download a backup file

    public function download($file_name)
    {
        $backupPath = storage_path("app/backups/{$file_name}");

        if (file_exists($backupPath)) {
            return response()->download($backupPath);
        }

        return redirect()->back()->with('error', 'File not found.');
    }

    // Import a backup file

    public function import($fileName)
    {
        try {
            $filePath = storage_path("app/backups/{$fileName}");

            if (!file_exists($filePath)) {
                return back()->with('error', 'The selected backup file does not exist.');
            }

            // Read the SQL file
            $sql = file_get_contents($filePath);

            // Split SQL statements and execute them
            $statements = array_filter(array_map('trim', explode(";\n", $sql)));

            DB::transaction(function () use ($statements) {
                foreach ($statements as $statement) {
                    DB::statement($statement);
                }
            });

            return back()->with('success', 'Database imported successfully!');
        } catch (\Exception $e) {
            if ($e->getMessage() != 'There is no active transaction') {
                return back()->withErrors('Error: ' . $e->getMessage());
            }
            return back()->with('warning', 'There is no active transaction but import process is done');
        }
    }

    public function delete($fileName)
    {
        try {
            // Define the disk used for backups
            $disk = Storage::disk('backups');

            // Check if the file exists
            if (!$disk->exists($fileName)) {
                return redirect()->back()->with('error', 'Backup file not found!');
            }

            // Delete the file
            $disk->delete($fileName);

            return redirect()->back()->with('success', 'Backup deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting backup: ' . $e->getMessage());
        }
    }

    public function formatFileSize($bytes, $decimalPlaces = 2)
    {
        // File Units
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        // Calculate the size
        $factor = floor((strlen($bytes) - 1) / 3);

        // Format the size and append the unit
        return sprintf("%.{$decimalPlaces}f", $bytes / pow(1024, $factor)) . ' ' . $units[$factor];
    }
}
