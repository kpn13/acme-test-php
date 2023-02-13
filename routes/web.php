<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

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
Route::controller(TodoController::class)->group(function () {
    Route::get('/todos', 'index')->name('todo.index');
    Route::get('/todos/{id}', 'show')->name('todo.show');
    Route::delete('/todos/{id}', 'delete')->name('todo.delete');
    Route::post('/todos', 'store')->name('todo.store');
    Route::get('/todos/{id}/edit', 'edit')->name('todo.edit');
    Route::put('/todos/{id}', 'update')->name('todo.update');
});
