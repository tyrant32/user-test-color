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

Route::post('/ajax/users/list', 'UsersController@ajaxUsersList')->name('ajax.users.list');
Route::post('/ajax/users/modal', 'UsersController@ajaxUsersModal')->name('ajax.users.modal');
