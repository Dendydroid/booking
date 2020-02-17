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
    return view('home');
})->middleware('auth');

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/rooms', 'HomeController@rooms')->name('rooms');
Route::get('/clients', 'HomeController@clients')->name('clients');
Route::get('/booking', 'HomeController@booking')->name('booking');
Route::get('/statistics', 'HomeController@statistics')->name('statistics');

Route::get('/add-room', 'HomeController@addRoom')->name('add-room');
Route::get('/edit-room/{id}', 'HomeController@editRoom')->name('edit-room');
Route::get('/manage-rooms', 'HomeController@manageRooms')->name('manage-rooms');


Route::post('/add-room', 'ManagementController@addRoom')->name('add-room');
Route::post('/edit-room', 'ManagementController@editRoom')->name('edit-room');
Route::post('/delete-room', 'ManagementController@deleteRoom')->name('delete-room');

Route::get('/add-booking', 'HomeController@addBooking')->name('add-booking');
Route::get('/manage-bookings', 'HomeController@manageBookings')->name('manage-bookings');

Route::post('/evict/{number}', 'ManagementController@evict')->name('evict');

Route::get('/blacklist/{id}', 'ManagementController@blacklist')->name('blacklist');
Route::get('/de-blacklist/{id}', 'ManagementController@deBlacklist')->name('de-blacklist');


Route::post('/add-booking', 'ManagementController@addBooking')->name('add-booking');

Route::get('/manage-clients', 'HomeController@manageClients')->name('manage-clients');

Route::get('/add-client', 'HomeController@addClient')->name('add-client');

Route::get('/edit-client', 'HomeController@editClient')->name('edit-client');

Route::post('/add-client', 'ManagementController@addClient')->name('add-client');


