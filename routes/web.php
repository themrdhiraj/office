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

Auth::routes();
  
Route::resource('/home', 'EmployeeController');
Route::get('/admin', 'AdminController@dashboard')->name('admin');
Route::get('/adminSettings', 'AdminController@settings')->name('adminSettings');

// Settings
Route::get('/adminSettings/{id}', 'DepartmentController@index');
Route::put('/depUpdate/{id}', 'DepartmentController@update');
Route::delete('/department/{id}/delete', 'DepartmentController@delete');
Route::post('/department', 'DepartmentController@store')->name('department');