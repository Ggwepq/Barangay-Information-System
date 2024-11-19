<?php

// phpcs:ignoreFile

use App\Http\Controllers\BackupController;
use App\Http\Controllers\BlotterController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HouseholdController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider and all of them will
 * | be assigned to the "web" middleware group. Make something great!
 * |
 */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Restricted', [HomeController::class, 'error']);
Route::get('/RestrictedAuth', [HomeController::class, 'error2']);

Auth::routes();

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::controller(ResidentController::class)->group(function () {
        // Residents
        Route::get('/Resident', 'index');
        Route::get('/Resident/Create', 'create');
        Route::get('/Resident/Edit/{id}', 'edit');
        Route::get('/Resident/Deactivate/{id}', 'destroy');
        Route::get('/Resident/Soft', 'soft');
        Route::post('/Resident/Store', 'store');
        Route::post('/Resident/Update/{id}', 'update');
        Route::get('/Resident/Remove/{id}', 'remove');
        Route::get('/Resident/Reactivate/{id}', 'reactivate');
        Route::get('/Resident/Mass', 'remove');

        // Non-residents
        Route::get('/Resident/NotResident', 'index2');
        Route::get('/Resident/NotResident/Create', 'create2');
        Route::get('/Resident/NotResident/Edit/{id}', 'edit2');
        Route::get('/Resident/NotResident/Deactivate/{id}', 'destroy2');
        Route::get('/Resident/NotResident/Soft', 'soft2');
        Route::get('/Resident/NotResident/Reactivate/{id}', 'reactivate2');
        Route::get('/Resident/NotResident/Remove/{id}', 'remove2');
        Route::post('/Resident/NotResident/Store', 'notResident');
        Route::post('/Resident/NotResident/Update/{id}', 'update2');
    });

    // Household
    Route::controller(HouseholdController::class)->group(function () {
        Route::get('/Household', 'index');
        Route::get('/Household/Create', 'create');
        Route::get('/Household/Inhabitant/{id}', 'inhabitant');
        Route::get('/Household/Edit/{id}', 'edit');
        Route::get('/Household/Deactivate/{id}', 'destroy');
        Route::get('/Household/Soft', 'soft');
        Route::get('/Household/Reactivate/{id}', 'reactivate');
        Route::get('/Household/Remove/{id}', 'remove');
        Route::post('/Household/Store', 'store');
        Route::post('/Household/Update/{id}', 'update');
    });

    // Officer
    Route::controller(OfficerController::class)->group(function () {
        Route::get('/Officer', 'index');
        Route::get('/Officer/Create', 'create');
        Route::get('/Officer/Edit/{id}', 'edit');
        Route::get('/Officer/Deactivate/{id}', 'destroy');
        Route::get('/Officer/Soft', 'soft');
        Route::get('/Officer/Reactivate/{id}', 'reactivate');
        Route::get('/Officer/Remove/{id}', 'remove');
        Route::post('/Officer/Store', 'store');
        Route::post('/Officer/Update/{id}', 'update');
    });

    // Projects
    Route::controller(ProjectController::class)->group(function () {
        Route::get('/Project', 'index');
        Route::get('/Project/Create', 'create');
        Route::get('/Project/Edit/{id}', 'edit');
        Route::get('/Project/Deactivate/{id}', 'destroy');
        Route::get('/Project/Soft', 'soft');
        Route::get('/Project/Reactivate/{id}', 'reactivate');
        Route::get('/Project/Remove/{id}', 'remove');
        Route::post('/Project/Store', 'store');
        Route::post('/Project/Update/{id}', 'update');
    });

    // Business
    Route::controller(BusinessController::class)->group(function () {
        Route::get('/Business', 'index');
        Route::get('/Business/Create', 'create');
        Route::get('/Business/Edit/{id}', 'edit');
        Route::get('/Business/Deactivate/{id}', 'destroy');
        Route::get('/Business/Soft', 'soft');
        Route::get('/Business/Reactivate/{id}', 'reactivate');
        Route::get('/Business/Remove/{id}', 'remove');
        Route::post('/Business/Store', 'store');
        Route::post('/Business/Update/{id}', 'update');
    });

    // Queries
    Route::get('/Query', [QueryController::class, 'index']);

    // Reports
    Route::controller(ReportController::class)->group(function () {
        Route::get('/Report', 'index');
        Route::get('/Report/Table/{start}/{end}', 'table');
        Route::get('/Report/Pdf/{start}/{end}', 'pdf');
    });

    // Backup
    Route::controller(BackupController::class)->group(function () {
        Route::get('/Backup', 'index');
        Route::get('/Backup/Create', 'create');
        Route::get('/Backup/Download', 'download');
        Route::get('/Backup/Delete', 'delete');
    });
});

Route::prefix('admin')->middleware('officer')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/month', [HomeController::class, 'month']);

    // Blotter
    Route::controller(BlotterController::class)->group(function () {
        Route::get('/Blotter', 'index');
        Route::get('/Blotter/Create', 'create');
        Route::get('/Blotter/Edit/{id}', 'edit');
        Route::get('/Blotter/Deactivate/{id}', 'destroy');
        Route::get('/Blotter/Soft', 'soft');
        Route::get('/Blotter/Reactivate/{id}', 'reactivate');
        Route::get('/Blotter/Remove/{id}', 'remove');
        Route::post('/Blotter/Store', 'store');
        Route::post('/Blotter/Update/{id}', 'update');
    });

    // Schedule
    Route::controller(ScheduleController::class)->group(function () {
        Route::get('/Schedule', 'index');
        Route::get('/Schedule/Create', 'create');
        Route::get('/Schedule/Edit/{id}', 'edit');
        Route::get('/Schedule/Deactivate/{id}', 'destroy');
        Route::get('/Schedule/Soft', 'soft');
        Route::get('/Schedule/Reactivate/{id}', 'reactivate');
        Route::get('/Schedule/Remove/{id}', 'remove');
        Route::post('/Schedule/Store', 'store');
        Route::post('/Schedule/Update/{id}', 'update');
    });

    // Forms
    Route::controller(PdfController::class)->group(function () {
        Route::get('/BarangayClearance/Print/{id}', 'index');
        Route::get('/BusinessPermit/Print/{id}', 'business');
        Route::get('/CertificateIndigency/Print/{id}', 'indigency');
        Route::get('/FiletoAction/Print/{id}', 'file');
    });

    // Test Routes
    Route::controller(TestController::class)->group(function () {
        Route::get('/BarangayClearance/{id}', 'index');
        Route::get('/FiletoAction/{id}', 'fileToAction');
    });
});
