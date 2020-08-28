<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth'

], function ($router) {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::get('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::group([
    'prefix' => 'event'

], function () {
    Route::post('create', 'AdminController@create');
    Route::get('index', 'EventsController@index');
    Route::post('client/select','ClientController@select');
    Route::post('client/unselect', 'ClientController@unselect');
    Route::post('delete', 'AdminController@delete');
    Route::post('addUser', 'AdminController@eventAddUser');
    Route::post('addUser', 'AdminController@eventAddUser');
});



Route::group([
    'prefix' => 'users'

], function () {
    Route::post('list', 'AdminController@usersIndex');
    Route::post('profile/submit', 'ClientController@submitForm');
});


Route::group([
    'prefix' => 'google'

], function () {
    Route::get('cal', 'gCalendarController@indexAll');
    Route::get('free', 'gCalendarControlle@getFreeEvents');
});


Route::post('contact', 'ContactController@submitForm');