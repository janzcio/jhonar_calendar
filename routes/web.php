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
    return view('calendar.index');
});

Route::get('/calendar', function () {
    return view('calendar.index');
});

/*calendar*/
Route::get('/calendar/load', 'CalendarController@loadCalendar');
Route::post('/calendar/insert', 'CalendarController@insertEvent');
Route::post('/calendar/update', 'CalendarController@updateEvent');
Route::post('/calendar/delete', 'CalendarController@deleteEvent');

