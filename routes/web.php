<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('categories', 'CategoryController@index');
//Route::get('/basket/index', 'BasketController@index')->name('basket.index');
//Route::get('/basket/checkout', 'BasketController@checkout')->name('basket.checkout');

Route::post('/basket/add/{product}', 'BasketController@add')->name('basket.add');
Route::resource('categories', CategoryController::class)->only(['index', 'show']);
Route::post('/basket/plus/{product}', 'BasketController@plus')->name('basket.plus');
Route::post('/basket/minus/{product}', 'BasketController@minus')->name('basket.minus');
