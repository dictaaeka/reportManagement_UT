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

    // Reports
    Route::resource('reports', ReportController::class);

    Route::middleware('admin')->group(function () {
        // Issues
        Route::resource('issues', IssueController::class)->except(['show']);

        // Sites
        Route::resource('sites', SiteController::class)->except(['show']);
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
