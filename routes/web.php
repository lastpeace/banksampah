<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenarikanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\SetoranController;


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/nasabah', [NasabahController::class, 'index'])->name('nasabah.index');
    Route::resource('nasabah', NasabahController::class)->except(['index']);
    Route::get('/setoran', [SetoranController::class, 'index'])->name('setoran.index');
    Route::resource('setoran', SetoranController::class)->except(['index']);
    Route::get('/penarikan', [PenarikanController::class, 'index'])->name('penarikan.index');
    Route::resource('penarikan', PenarikanController::class)->except(['index']);
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});


require __DIR__ . '/auth.php';
