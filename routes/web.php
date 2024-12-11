<?php

// phpcs:ignoreFile

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\BlotterController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\DocumentRequestController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HouseholdController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResidentAccountController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SMSController;
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

Route::get('/checkRole', [HomeController::class, 'homepage'])->name('check-role');

Route::prefix('admin')->middleware('officer')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/Workspace', function () {
        return view('iframe');
    });

    // Ajax Routes
    Route::get('/month', [HomeController::class, 'month']);
    Route::get('/blotter-months', [HomeController::class, 'blotterMonths']);
    Route::get('/age-groups', [HomeController::class, 'ageGroups']);
    Route::get('/genders', [HomeController::class, 'genders']);
    Route::get('/civil-status', [HomeController::class, 'civilStatus']);

    Route::controller(ResidentController::class)->group(function () {
        // Residents
        Route::get('/Resident', 'index');
        Route::get('/Resident/Create', 'create');
        Route::get('/Resident/Edit/{id}', 'edit')->name('residents.edit');
        Route::get('/Resident/Deactivate/{id}', 'destroy');
        Route::get('/Resident/Soft', 'soft');
        Route::post('/Resident/Store', 'store');
        Route::post('/Resident/Update/{id}', 'update');
        Route::get('/Resident/Remove/{id}', 'remove');
        Route::get('/Resident/Reactivate/{id}', 'reactivate');
        Route::get('/Resident/Mass', 'remove');
    });

    // Accounts
    Route::controller(ResidentAccountController::class)->group(function () {
        Route::get('/Resident/Account', 'index');
        Route::get('/Resident/Account/Create', 'create');
        Route::get('/Resident/Account/Edit/{id}', 'edit');
        Route::get('/Resident/Account/Deactivate/{id}', 'destroy');
        Route::get('/Resident/Account/Soft', 'soft2');
        Route::get('/Resident/Account/Reactivate/{id}', 'reactivate');
        Route::get('/Resident/Account/Remove/{id}', 'remove');
        Route::post('/Resident/Account/Store', 'store');
        Route::post('/Resident/Account/Update/{id}', 'update');
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

    // Officer
    Route::controller(PositionController::class)->group(function () {
        Route::get('/Position', 'index');
        Route::get('/Position/Create', 'create');
        Route::get('/Position/Edit/{id}', 'edit');
        Route::get('/Position/Deactivate/{id}', 'destroy');
        Route::get('/Position/Soft', 'soft');
        Route::get('/Position/Reactivate/{id}', 'reactivate');
        Route::get('/Position/Remove/{id}', 'remove');
        Route::post('/Position/Store', 'store');
        Route::post('/Position/Update/{id}', 'update');
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

    // Queries
    Route::get('/Query', [QueryController::class, 'index']);

    // Reports
    Route::controller(ReportController::class)->group(function () {
        Route::get('/Report', 'index');
        Route::get('/Report/Query/resident', 'report');
        Route::get('/Report/Query/blotter', 'report');
        Route::get('/Report/Query/projects', 'report');
        Route::get('/Report/Table', 'table');
        Route::get('/Report/Pdf/{start}/{end}', 'pdf');
    });

    // Backup
    Route::controller(BackupController::class)->group(function () {
        Route::get('/Backup', 'index');
        Route::get('/Backup/Create', 'backup')->name('backup.create');
        Route::get('/Backup/Download/{file_name}', 'download')->name('backup.download');
        Route::get('/Backup/Import/{file_name}', 'import')->name('backup.import');
        Route::get('/Backup/Delete/{fileName}', 'delete')->name('backup.delete');
    });

    Route::controller(LocationController::class)->group(function () {
        Route::get('/get-provinces', 'getProvinces');
        Route::get('/get-cities', 'getCities');
        Route::get('/get-barangays', 'getBarangays');
    });

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
        Route::get('/CertificateResidency/Print/{id}', 'residency');
        Route::get('/CertificateGoodMoral/Print/{id}', 'goodMoral');
        Route::get('/FiletoAction/Print/{id}', 'file');
    });

    // Document
    Route::controller(DocumentRequestController::class)->group(function () {
        Route::get('/document', 'viewPendingRequests');
        Route::get('/document/actioned', 'viewActionedRequests');
        Route::get('/document/foruser', 'viewGenerateForUser');
        Route::get('/document/edit', 'createRequest');
        Route::post('/document/update/{id}', 'reviewRequest');
        Route::get('/document/delete/{id}', 'deleteRequest');
    });

    // Announcement
    Route::controller(AnnouncementsController::class)->group(function () {
        Route::get('/announcement', 'index');
        Route::get('/announcement/create', 'create');
        Route::get('/announcement/announce/{id}', 'announce');
        Route::post('/announcement/store', 'store');
        Route::get('/announcement/remove/{id}', 'remove');
    });

    // Settings
    Route::controller(SettingController::class)->group(function () {
        Route::get('/settings', 'index');
        Route::post('/settings/update', 'updateSettings');
    });
});

Route::prefix('user')->middleware('resident')->group(function () {
    Route::get('/home', [UserController::class, 'index'])->name('user-home');

    Route::controller(DocumentRequestController::class)->group(function () {
        Route::get('/document', 'viewRequests');
        Route::get('/document/create', 'createRequest');
        Route::get('/document/delete/{id}', 'deleteRequest');
        Route::post('/document/store', 'requestDocument');
    });

    Route::controller(PdfController::class)->group(function () {
        Route::get('/document/barangay-clearance/{id}', 'index');
        Route::get('/document/certificate-of-indigency/{id}', 'indigency');
        Route::get('/document/certificate-of-residency/{id}', 'residency');
        Route::get('/document/certificate-of-good-moral/{id}', 'goodMoral');
    });

    Route::controller(AnnouncementsController::class)->group(function () {
        Route::get('/announcement', 'list');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/profile', 'profile');
    });
});
