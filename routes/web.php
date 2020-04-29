<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('payment', 'PaypalProgressControllers@payment')->name('payment');
Route::get('cancel', 'PaypalProgressControllers@cancel')->name('payment.cancel');
Route::get('payment/success', 'PaypalProgressControllers@success')->name('payment.success');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
