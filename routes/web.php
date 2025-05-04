<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DailyLogController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CheckRole;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('pages.dashboard.index');
// })->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('dashboard')->group(function () {
    Route::resource('manage-position', PositionController::class)->middleware('checkrole:1,2');
    Route::resource('manage-user', UserController::class)->middleware('checkrole:1,2');
    Route::resource('manage-daily-log', DailyLogController::class);
    Route::get('manage-daily-log/calendar', [DailyLogController::class, 'daily_log_calendar'])->middleware('checkrole:1,2');

    Route::get('manage-daily-log/accept/status/{id}', [DailyLogController::class, 'accepted'])->name('accept.status');
    Route::get('manage-daily-log/reject/status/{id}', [DailyLogController::class, 'rejected'])->name('reject.status');
})->middleware(['auth']);

require __DIR__.'/auth.php';
