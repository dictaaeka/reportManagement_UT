<?php

use App\Http\Controllers\IssueController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    // Semua orang (guest, user, admin) langsung diarahkan ke halaman Reports.
    // Login hanya diperlukan kalau mau melakukan CRUD (lihat grup admin di bawah).
    return redirect()->route('reports.index');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return redirect()->route('reports.index');
    })->name('dashboard');

    Route::middleware('admin')->group(function () {
        // Reports — create/store/edit/update/destroy khusus Admin.
        // HARUS didaftarkan SEBELUM reports.show (wildcard /reports/{report})
        // di bawah, biar /reports/create tidak ketiban wildcard.
        Route::resource('reports', ReportController::class)->only([
            'create', 'store', 'edit', 'update', 'destroy',
        ]);

        // Users
        Route::resource('users', UserController::class)->except(['show']);

        // Issues
        Route::resource('issues', IssueController::class)->except(['show']);

        // Sites
        Route::resource('sites', SiteController::class)->except(['show']);

        // Customers
        Route::resource('customers', CustomerController::class)->except(['show']);
    });

    /*
    |--------------------------------------------------------------------------
    | Notification
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/notifications/{notification}/read',
        [NotificationController::class, 'markAsRead']
    )->name('notifications.read');

    Route::post(
        '/notifications/read-all',
        [NotificationController::class, 'markAllAsRead']
    )->name('notifications.readAll');

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Reports — Public (Guest, User, Admin)
|--------------------------------------------------------------------------
| index/show/preview/download boleh diakses TANPA login.
| File PDF tetap aman karena selalu di-stream lewat controller dari disk
| 'local' (private) — tidak pernah lewat URL publik langsung.
| Didaftarkan SETELAH grup admin di atas supaya /reports/create tetap
| menang atas wildcard /reports/{report} di bawah ini.
*/
Route::resource('reports', ReportController::class)->only(['index', 'show']);

Route::get(
    'reports/{report}/preview',
    [ReportController::class, 'preview']
)->name('reports.preview');

Route::get(
    'reports/{report}/download',
    [ReportController::class, 'download']
)->name('reports.download');

require __DIR__ . '/auth.php';