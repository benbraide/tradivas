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
})->name('home');

Route::get('login', function () {
    return view('login');
})->middleware('guest')->name('login');

Route::get('register', function () {
    return view('register');
})->middleware('guest')->name('register');

Route::get('password', function () {
    return view('password');
})->middleware('guest')->name('password');

Route::get('admin', function () {
    if (Auth::user()->is_admin())
        return view('admin');
    return redirect('/');
})->middleware('auth')->name('admin');

Route::get('themes/{id}', function ($id) {
    if (Auth::user()->is_admin())
        return view('theme', ['page_theme_id' => $id]);
    return redirect('/');
})->middleware('auth')->name('themes');

Route::get('logout', array('uses' => 'Auth\LoginController@logout'))->name('logout');

Route::post('attempt_login', array('uses' => 'Auth\LoginController@login'));
Route::post('attempt_register', array('uses' => 'Auth\RegisterController@register'));
Route::post('attempt_password', array('uses' => 'Auth\ResetPasswordController@reset'));

Route::post('sizes/create', array('uses' => 'AdminController@createSize'))->middleware('auth');
Route::post('colors/create', array('uses' => 'AdminController@createColor'))->middleware('auth');
Route::post('items/create', array('uses' => 'AdminController@createItem'))->middleware('auth');

Route::post('settings/update', array('uses' => 'AdminController@updateSettings'))->middleware('auth');
Route::post('themes/{id}/update', array('uses' => 'AdminController@updateTheme'))->middleware('auth');
