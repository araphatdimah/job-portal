<?php

use App\Http\Controllers\Auth\portalAuthController;
use App\Http\Controllers\Auth\employerAuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(portalAuthController::class)->group(function(){
    Route::get('/portal', 'index')->middleware('portal')->name('pages.portal');
    Route::get('/portal-login', 'login')->name('pages.portal-login');
    Route::post('/portal-login', 'signin');
    Route::get('/portal-register', 'register')->name('pages.portal-register');
    Route::post('/portal-register', 'registerMember');
    Route::post('/portal-profile-edit/{portalId}', 'profilEdit');
    Route::post('/portal-password-change/{portalId}', 'passwordChange');
    Route::post('/portal-logout', 'destroy');
});

Route::controller(employerAuthController::class)->group(function(){
    Route::get('/employer-portal', 'index')->middleware('employer')->name('pages.employer-portal');
    Route::get('/employer-login', 'login')->name('pages.employer-login');
    Route::post('/employer-login', 'signin');
    Route::post('/new-job-opportunity', 'addJobOpportunity');
    Route::get('/employer-register', 'register')->name('pages.employer-register');
    Route::post('/employer-register', 'registerCompany');
    Route::post('/employer-profile-edit/{employerId}', 'profilEdit');
    Route::post('/employer-password-change/{employerId}', 'passwordChange');
    Route::post('/employer-logout', 'destroy');
});


require __DIR__.'/auth.php';
