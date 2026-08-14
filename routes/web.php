<?php

use App\Http\Controllers\IssueController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('reports.index')
        : redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return redirect()->route('reports.index');
    })->name('dashboard');

    // Issues
    Route::resource('issues', IssueController::class)->except(['show']);

    // Sites
    Route::resource('sites', SiteController::class)->except(['show']);

    // Reports
    Route::resource('reports', ReportController::class);

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
    | Admin Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware('admin')->group(function () {

        Route::resource('issues', IssueController::class)
            ->except(['index', 'show']);

        Route::resource('sites', SiteController::class)
            ->except(['index', 'show']);

        Route::resource('reports', ReportController::class)
            ->except(['index', 'show']);
    });

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