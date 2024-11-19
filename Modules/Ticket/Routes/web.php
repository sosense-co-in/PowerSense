<?php

use Illuminate\Support\Facades\Route;
// use $MODULE_NAMESPACE$\Ticket\$CONTROLLER_NAMESPACE$\TicketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([], function () {
    Route::resource('ticket', TicketController::class)->names('ticket');



});

Route::middleware(['auth'])->group(function () {
    Route::resource('tickets', TicketController::class);
    Route::post('tickets/{id}/reply', [TicketController::class, 'reply'])->name('tickets.reply');


});
