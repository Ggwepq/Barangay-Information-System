<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
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

    public function create()
    {
        try {
            $backupFile = 'backups/db_backup_' . now()->format('Y_m_d_H_i_s') . '.sql';
            $path = storage_path('app/' . $backupFile);

            // Open a file for writing
            $handle = fopen($path, 'w');
            if (!$handle) {
                throw new Exception("Unable to create backup file at {$path}");
            }

            // Fetch all tables in the database
            $tables = \DB::select('SHOW TABLES');
            $dbName = env('DB_DATABASE');
            $key = 'Tables_in_' . $dbName;  // Key name varies with MySQL

            // Iterate over tables
            foreach ($tables as $table) {
                $tableName = $table->$key;

                // Get CREATE TABLE statement
                $createTable = \DB::select("SHOW CREATE TABLE `{$tableName}`");
                $createSQL = $createTable[0]->{'Create Table'} . ";\n\n";
                fwrite($handle, $createSQL);

                // Fetch table rows
                $rows = \DB::table($tableName)->get();
                foreach ($rows as $row) {
                    $rowArray = (array) $row;
                    $columns = implode('`, `', array_keys($rowArray));
                    $values = implode("', '", array_map(function ($value) {
                        return addslashes($value);
                    }, array_values($rowArray)));

                    $insertSQL = "INSERT INTO `{$tableName}` (`{$columns}`) VALUES ('{$values}');\n";
                    fwrite($handle, $insertSQL);
                }
                fwrite($handle, "\n");
            }

            fclose($handle);

            Log::info("Database backup created successfully at {$path}");

            return redirect()->back()->withSuccess('Successfully backed up database');
        } catch (Exception $e) {
            Log::error('Backup failed: ' . $e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function download($file_name)
    {
        $file = 'backups/' . $file_name;
        $disk = Storage::disk('local');

        if ($disk->exists($file)) {
            return response()->download(storage_path('app/' . $file));
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }

    public function delete($file_name)
    {
        $file = 'backups/' . $file_name;
        $disk = Storage::disk('local');

        if ($disk->exists($file)) {
            $disk->delete($file);
            return redirect()->back()->withSuccess('Backup deleted successfully');
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }

    public function formatFileSize($bytes, $decimalPlaces = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimalPlaces}f", $bytes / pow(1024, $factor)) . ' ' . $units[$factor];
    }
}
