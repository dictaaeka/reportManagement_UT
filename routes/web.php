<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IssueController;
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
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('issues', IssueController::class)->except(['show']);
    Route::resource('sites', SiteController::class)->except(['show']);
    Route::resource('reports', ReportController::class);

    Route::middleware('admin')->group(function () {
        Route::resource('issues', IssueController::class)->except(['index', 'show']);
        Route::resource('sites', SiteController::class)->except(['index', 'show']);
        Route::resource('reports', ReportController::class)->except(['index', 'show']);
    });

    Route::get('reports/{report}/preview', [ReportController::class, 'preview'])->name('reports.preview');
    Route::get('reports/{report}/download', [ReportController::class, 'download'])->name('reports.download');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
