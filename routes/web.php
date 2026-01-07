<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClockController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/clocks', [ClockController::class, 'index'])->name('clocks.index');
    Route::post('/clocks', [ClockController::class, 'store'])->name('clocks.store');
    Route::get('/clocks/{id}/edit', [ClockController::class, 'edit'])->name('clocks.edit');
    Route::put('/clocks/{id}', [ClockController::class, 'update'])->name('clocks.update');
    Route::delete('/clocks/{id}', [ClockController::class, 'destroy'])->name('clocks.destroy');
    Route::get('pdf/pessoal/{user}', [App\Http\Controllers\PdfController::class, 'generatePersonalPdf'])->name('pdf.pessoal');
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/dashboard/{id}', [AdminController::class, 'show'])->name('admin.users.show');
    Route::delete('/admin/dashboard/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    Route::delete('/admin/clocks/{id}', [AdminController::class, 'destroyClock'])->name('admin.clocks.destroy');
    Route::get('/pdf/usuarios', [App\Http\Controllers\PdfController::class, 'generateAllUsersPdf'])
        ->name('pdf.usuarios');
});

require __DIR__ . '/auth.php';
