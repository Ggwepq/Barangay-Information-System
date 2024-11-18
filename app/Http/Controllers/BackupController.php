<?php

// phpcs:ignoreFile

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function index()
    {
        $disk = Storage::disk(config('backup.destination.disks')[0]);

        $files = $disk->files(config('app.name'));
        $now = Carbon::now();
        $backups = [];
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $lastModifiedDate = Carbon::createFromTimestamp($disk->lastModified($f));
                $fileAge = $lastModifiedDate->diffForHumans($now, true);

                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('app.name') . '/', '', $f),
                    'file_size' => BackupController::formatFileSize($disk->size($f)),
                    'file_age' => $fileAge,
                    'last_modified' => $lastModifiedDate->format('Y-m-d')
                ];
            }
        }

        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);

        return view("Backup.index", compact('backups'));
    }

    public function create()
    {
        try {
            // start the backup process
            Artisan::call('backup:run', ['--only-db' => true]);

            $output = Artisan::output();
            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            // return the results as a response to the ajax call
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->back()->withSuccess('Successfully Backed up Database');
    }

    /**
     * Downloads a backup zip file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function download($file_name)
    {
        $file = config('laravel-backup.backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);
        if ($disk->exists($file)) {
            $fs = Storage::disk(config('laravel-backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);

            return Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }

    /**
     * Deletes a backup file.
     */
    public function delete($file_name)
    {
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);
        if ($disk->exists(config('laravel-backup.backup.name') . '/' . $file_name)) {
            $disk->delete(config('laravel-backup.backup.name') . '/' . $file_name);
            return redirect()->back();
        } else {
            abort(404, "The backup file doesn't exist.");
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
