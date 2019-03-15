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
    return view('main');
});

Route::get('admin/export', 'AdminController@export');
Route::resource('/admin', 'AdminController');

Route::resource('attendees', 'AttendeeController');
Route::post('attendees/checkin', 'AttendeeController@checkin')->name('attendees.checkin');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
