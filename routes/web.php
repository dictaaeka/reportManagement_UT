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
    $user = auth()->user();

    if (!$user) {
        return redirect()->route('login');
    }

    return redirect()->route('reports.index');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return redirect()->route('reports.index');
    })->name('dashboard');

    Route::middleware('admin')->group(function () {
        // Reports — create/store/edit/update/destroy khusus Admin
        // HARUS didaftarkan SEBELUM index/show, biar /reports/create
        // gak ketiban wildcard /reports/{report}
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

    // Reports — index & show boleh diakses semua user yang login
    // Didaftarkan SETELAH blok admin di atas
    Route::resource('reports', ReportController::class)->only(['index', 'show']);

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
    | Report Preview & Download
    |--------------------------------------------------------------------------
    */

    Route::get(
        'reports/{report}/preview',
        [ReportController::class, 'preview']
    )->name('reports.preview');

    Route::get(
        'reports/{report}/download',
        [ReportController::class, 'download']
    )->name('reports.download');

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

require __DIR__ . '/auth.php';