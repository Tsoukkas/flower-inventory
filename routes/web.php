<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlowerController;

Route::get('/', [FlowerController::class, 'index'])->name('home');

Route::prefix('flowers')->name('flowers.')->group(function () {
    Route::get('/', [FlowerController::class, 'index'])->name('index');             // Home list + search/sort
    Route::get('/create', [FlowerController::class, 'create'])->name('create');     // Add page
    Route::post('/', [FlowerController::class, 'store'])->name('store');            // Create
    Route::get('/{id}', [FlowerController::class, 'show'])->name('show');           // Details
    Route::get('/{id}/edit', [FlowerController::class, 'edit'])->name('edit');      // Edit page
    Route::put('/{id}', [FlowerController::class, 'update'])->name('update');       // Update
    Route::get('/{id}/delete', [FlowerController::class, 'delete'])->name('delete');// Delete confirm page
    Route::delete('/{id}', [FlowerController::class, 'destroy'])->name('destroy');  // Delete
});