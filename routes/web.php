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
//logout
Route::get('/logout', 'HomeController@logout')->name('logoutt');

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/newHomework', 'HomeWorkController@newHomeworkView')->name('newHomework');
Route::post('/newHomework', 'HomeWorkController@newHomework');
Route::get('/homeworkList', 'HomeWorkController@homeworkListView')->name('homeworkList');
Route::get('/homeworkListDataTable', 'HomeWorkController@homeworkListDataTable');
Route::post('/updateHomework', 'HomeWorkController@updateHomework');
Route::post('/homeWorkDelete', 'HomeWorkController@deleteHomework');
Route::get('/reportStatus', 'HomeWorkController@reportStatus');

