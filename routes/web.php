<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\RegisterVerify;
use App\Livewire\Settings\ProfileSettings;
use App\Livewire\Settings\SecuritySettings;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->get('/', function () {
    return view('pages.welcome');
})->name('welcome');

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');

    Route::get('/register/verify', RegisterVerify::class)
        ->name('register.verify')
        ->middleware('registration.session');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    Route::get('/profile-settings', ProfileSettings::class)->name('profile-settings');

    Route::get('/security-settings', SecuritySettings::class)->name('security-settings');

    Route::post('/logout', function () {
        auth()->logout();

        return redirect()->route('welcome');
    })->name('logout');
});
