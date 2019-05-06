<?php
declare(strict_types=1);

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'UsersController@index')->name('home');

Route::namespace('Ajax')->prefix('ajax')->group(function () {
    Route::post('users/list', 'UsersController@index')->name('ajax.users.list');
    Route::post('users/modal', 'UsersController@modal')->name('ajax.users.modal');
    Route::post('users/store', 'UsersController@store')->name('ajax.users.store');
    Route::post('users/update', 'UsersController@update')->name('ajax.users.update');
});
