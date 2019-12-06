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

//Route::get('/', 'PagesController@home');


Auth::routes(['register'=>false]);
//Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/', 'HomeController@index')->name('home');

//manual routes for crud
//Route::get('/users', 'UsersController@index');
//
//Route::get('/users/create', 'UsersController@create');
//
//Route::get('/users/{employee}', 'UsersController@show');
//
//Route::post('/users', 'UsersController@store');
//
//Route::delete('/users/{employee}', 'UsersController@destroy');
//
//Route::get('/users/{employee}/edit', 'UsersController@edit');
//
//Route::put('/users/{employee}', 'UsersController@update');

//auto routes for crud (in conditon: it's using php artisan make:controller NameController -r -m ModelName
Route::resource('users', 'UsersController');
Route::resource('stuffs', 'StuffsController');
Route::resource('categories', 'CategoriesController');
Route::resource('debt-histories', 'DebtHistoriesController');
Route::resource('histories', 'HistoriesController');
Route::resource('profiles', 'ProfilesController');
//Route::resource('in-transactions', 'InTransactionsController');

Route::get('/in-transactions', 'InTransactionsController@index');
Route::put('/in-transactions', 'InTransactionsController@update');
Route::resource('out-transactions', 'OutTransactionsController');

Route::resource('reports', 'ReportsController');
Route::resource('units', 'UnitsController');


Route::get('/users', [
    'middleware' => 'auth',
    'uses' => 'UsersController@index'
]);
Route::get('/stuffs', [
    'middleware' => 'auth',
    'uses' => 'StuffsController@index'
]);
Route::get('/categories', [
    'middleware' => 'auth',
    'uses' => 'CategoriesController@index'
]);
Route::get('/debt-histories', [
    'middleware' => 'auth',
    'uses' => 'DebtHistoriesController@index'
]);
Route::get('/histories', [
    'middleware' => 'auth',
    'uses' => 'HistoriesController@index'
]);
Route::get('/in-transactions', [
    'middleware' => 'auth',
    'uses' => 'InTransactionsController@index'
]);
Route::get('/out-transactions', [
    'middleware' => 'auth',
    'uses' => 'OutTransactionsController@index'
]);
Route::get('/reports', [
    'middleware' => 'auth',
    'uses' => 'ReportsController@index'
]);
Route::get('/units', [
    'middleware' => 'auth',
    'uses' => 'UnitsController@index'
]);

//Route::get('/register', [
//    'middleware' => 'auth',
//    'uses' => 'HomeController@index'
//]);
