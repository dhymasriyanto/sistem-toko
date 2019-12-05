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

Route::get('/', 'PagesController@home');

//manual routes for crud
//Route::get('/employees', 'EmployeesController@index');
//
//Route::get('/employees/create', 'EmployeesController@create');
//
//Route::get('/employees/{employee}', 'EmployeesController@show');
//
//Route::post('/employees', 'EmployeesController@store');
//
//Route::delete('/employees/{employee}', 'EmployeesController@destroy');
//
//Route::get('/employees/{employee}/edit', 'EmployeesController@edit');
//
//Route::put('/employees/{employee}', 'EmployeesController@update');

//auto routes for crud (in conditon: it's using php artisan make:controller NameController -r -m ModelName
Route::resource('employees', 'EmployeesController');
Route::resource('stuffs', 'StuffsController');
Route::resource('categories', 'CategoriesController');
Route::resource('debt-histories', 'DebtHistoriesController');
Route::resource('histories', 'HistoriesController');
Route::resource('in-transactions', 'InTransactionsController');
Route::resource('out-transactions', 'OutTransactionsController');
Route::resource('reports', 'ReportsController');
Route::resource('units', 'UnitsController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
