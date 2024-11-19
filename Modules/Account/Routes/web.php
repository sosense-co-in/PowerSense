<?php

use Illuminate\Support\Facades\Route;
use Modules\Account\Http\Controllers\AccountController;

Route::prefix('account')->middleware('auth')->group(function () {
    Route::get('/', [AccountController::class, 'index'])->name('account.index');
    Route::get('/create', [AccountController::class, 'create'])->name('account.create');
    Route::post('/', [AccountController::class, 'store'])->name('account.store');
    Route::get('/{id}', [AccountController::class, 'show'])->name('account.show');
    Route::get('/{id}/edit', [AccountController::class, 'edit'])->name('account.edit');
    Route::put('/{id}', [AccountController::class, 'update'])->name('account.update');
    Route::delete('/{id}', [AccountController::class, 'destroy'])->name('account.destroy');
});
