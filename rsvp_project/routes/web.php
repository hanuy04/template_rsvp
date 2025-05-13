<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RSVPController;

// Landing page → tombol Isi Data Diri
Route::get('/', function () {
    return view('welcome');
});

// Public RSVP form
Route::get('rsvp', [RSVPController::class, 'showForm'])->name('rsvp.form');
Route::post('rsvp', [RSVPController::class, 'submitForm'])->name('rsvp.submit');

// Login & Logout admin
Route::get('login', [AdminController::class, 'showLoginForm'])->name('login');
Route::post('login', [AdminController::class, 'login'])->name('login.post');
Route::post('logout', [AdminController::class, 'logout'])->name('logout');

// Admin dashboard (cek session di controller)
Route::get('admin/dashboard', [RSVPController::class, 'dashboard'])->name('admin.dashboard');
Route::get('admin/export-csv', [RSVPController::class, 'exportCsv'])->name('admin.export.csv');
