<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthenticatedSessionController;
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



Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::get('/user-login/{id}', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::get('/sndlnk', [App\Http\Controllers\HomeController::class, 'sendEmailLink']);



Route::middleware('auth')->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // }); 
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::post('save-vote', [HomeController::class, 'saveVote'])->name('save-vote');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('users', [HomeController::class, 'listUsers'])->name('users');
    Route::get('listAllUsers', [HomeController::class, 'listAllUsers'])->name('listAllUsers');
    Route::get('remind-email/{id}', [HomeController::class, 'sendManualReminderEmail'])->name('remind-email');
    Route::get('edit-user/{id}', [HomeController::class, 'editUser'])->name('edit-user');
    Route::get('fdashboard', [HomeController::class, 'backendDashboard'])->name('fdashboard');
    Route::post('updateUser/{id}', [HomeController::class, 'updateUser'])->name('updateUser');
    Route::get('fRpt', [HomeController::class, 'generatePdfVote'])->name('fRpt');
    
});

require __DIR__.'/auth.php';
