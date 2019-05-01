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


Route::get('/', 'ChartController@index');
Route::get('/exam', 'ChartController@exam')->name('exam');
Route::get('/exam2', 'ChartController@exam2')->name('exam2');
Route::get('/exam3', 'ChartController@exam3')->name('exam3');
Route::get('/exam4', 'ChartController@exam4')->name('exam4');
Route::get('/exam5', 'ChartController@exam5')->name('exam5');
Route::post('/submitExam', 'ChartController@submit')->name('submitExam');
Route::get('/print/{id}', 'ChartController@print')->name('print');
Route::get('/delete/{id}', 'ChartController@delete')->name('delete');

Route::post('/chart', 'ChartController@findStudents')->name('search');

Route::get('/live_search/action', 'LiveSearch@action')->name('live_search.action');
Route::get('/upload', 'DataController@index')->name('upload');
Route::post('/uploadFile', 'DataController@uploadFile');

Route::get('/export', 'DataController@exportIndex')->name('export.index');
Route::get('/export/date', 'DataController@exportData')->name('export');
Route::get('/deleteDatabase', 'DataController@deleteDatabase')->name('deleteDatabase');
