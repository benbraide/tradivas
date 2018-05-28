<?php

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

Route::get('login', function () {
    return view('login');
})->middleware('guest');

Route::get('register', function () {
    return view('register');
})->middleware('guest');

Route::get('password', function () {
    return view('password');
})->middleware('guest');

Route::get('admin', function () {
    if (Auth::user()->is_admin())
        return view('admin');
    return redirect('/');
})->middleware('auth');

Route::get('logout', array('uses' => 'Auth\LoginController@logout'));

Route::post('attempt_login', array('uses' => 'Auth\LoginController@login'));
Route::post('attempt_register', array('uses' => 'Auth\RegisterController@register'));
Route::post('attempt_password', array('uses' => 'Auth\ResetPasswordController@reset'));

Route::post('sizes/create', array('uses' => 'AdminController@createSize'));
Route::post('colors/create', array('uses' => 'AdminController@createColor'));
Route::post('items/create', array('uses' => 'AdminController@createItem'));
Route::post('settings/update', array('uses' => 'AdminController@updateSettings'));
