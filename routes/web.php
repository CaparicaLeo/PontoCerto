<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/clocks', [App\Http\Controllers\ClockController::class, 'index'])->name('clocks.index');
    Route::post('/clocks', [App\Http\Controllers\ClockController::class, 'store'])->name('clocks.store');
    Route::get('/clocks/{id}/edit', [App\Http\Controllers\ClockController::class, 'edit'])->name('clocks.edit');
    Route::put('/clocks/{id}', [App\Http\Controllers\ClockController::class, 'update'])->name('clocks.update');
    Route::delete('/clocks/{id}', [App\Http\Controllers\ClockController::class, 'destroy'])->name('clocks.destroy');
});

require __DIR__.'/auth.php';
