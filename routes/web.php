<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AmcContractController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/sales-purchases/chart-data', 'HomeController@salesPurchasesChart')->name('sales-purchases.chart');

    Route::get('/current-month/chart-data', 'HomeController@currentMonthChart')->name('current-month.chart');

    Route::get('/payment-flow/chart-data', 'HomeController@paymentChart')->name('payment-flow.chart');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('tickets', TicketController::class);
    Route::post('tickets/{id}/reply', [TicketController::class, 'reply'])->name('tickets.reply');

    Route::resource('contact', ContactController::class);

    Route::get('/amc-contracts', [AmcContractController::class, 'index'])->name('amc-contracts.index');

    // GET route to show the form for creating a new AMC contract
    Route::get('/amc-contracts/create', [AmcContractController::class, 'create'])->name('amc-contracts.create');

    // POST route to store a newly created AMC contract
    Route::post('/amc-contracts', [AmcContractController::class, 'store'])->name('amc-contracts.store');

    // GET route to display a specific AMC contract by ID
    Route::get('/contracts/{id}', [AmcContractController::class, 'show'])->name('contracts.show');

    // GET route to show the form for editing a specific AMC contract by ID
    Route::get('/amc-contracts/{id}/edit', [AmcContractController::class, 'edit'])->name('contracts.edit');

    // PUT/PATCH route to update a specific AMC contract by ID
    Route::put('/amc-contracts/{id}', [AmcContractController::class, 'update'])->name('amc-contracts.update');
    Route::patch('/amc-contracts/{id}', [AmcContractController::class, 'update'])->name('amc-contracts.update');

    // DELETE route to remove a specific AMC contract by ID
    Route::delete('/amc-contracts/{id}', [AmcContractController::class, 'destroy'])->name('contracts.destroy');
});

Route::resource('amc-contracts', AmcContractController::class);
Route::get('amc-contracts/{id}/download', [AmcContractController::class, 'download'])->name('contracts.download');
Route::post('amc-contracts/{id}/change-status', [AmcContractController::class, 'changeStatus'])->name('amc-contracts.change-status');
Route::delete('amc-contracts/item/{id}', [AmcContractController::class, 'deleteContractItem'])->name('amc-contracts.delete-item');

Route::resource('account', AccountController::class);
