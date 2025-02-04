<?php

use App\Http\Controllers\PrizesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewPrizesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// Route::resource('prizes', PrizesController::class);


Route::get('/', function () {
    return redirect()->route('dashboard.index');
});
// Route::post('/simulate', '\App\Http\Controllers\PrizesController@simulate')->name('simulate');
// Route::post('/reset', '\App\Http\Controllers\PrizesController@reset')->name('reset');

Route::controller(DashboardController::class)->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', 'index')->name('index');
});
Route::controller(NewPrizesController::class)->prefix('prize')->name('prizes.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'update')->name('update');
    Route::get('/delete/{id}', 'destroy')->name('destroy');
});
