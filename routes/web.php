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

// Employee
Route::get('/employee', 'AdminController@addEmp')->name('addEmp');
Route::get('/employee/{id}', 'AdminController@editEmp');
Route::post('/storeEmp', 'AdminController@storeEmp')->name('storeEmp');
Route::delete('/delEmp/{id}', 'AdminController@delEmp');
Route::get('/viewEmp', 'AdminController@viewEmp')->name('viewEmp');

// Ongoing project
Route::get('/projects', 'OngoingProjectController@index')->name('project');
Route::get('/project', 'OngoingProjectController@create')->name('createProject');
Route::get('/project/{id}', 'OngoingProjectController@edit');
Route::delete('/delProj/{id}', 'OngoingProjectController@delete');
Route::post('/project', 'OngoingProjectController@store')->name('storeProject');