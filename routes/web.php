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

Route::get('/login-clutch', ['middleware' => 'guest', function() {
    return view('login-clutch');
}]);

Route::get('auth/linkedin', 'Auth\LoginController@redirectToProvider');

Route::get('auth/linkedin/callback', 'Auth\LoginController@handleProviderCallback');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

// Start Users Route
Route::get('/users', 'UserController@index')->name('users.index');

Route::post('/users', 'UserController@create')->name('users.create');

Route::delete('/users/{id}', 'UserController@destroy')->name('users.destroy');

Route::put('/users/{id}', 'UserController@update')->name('users.update');
// End Users Route
