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

Auth::routes(['register'=>false]);
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::resource('/', 'HomeController')->only([
    'index'
]);
Route::resource('users', 'UsersController')->except([
    'show'
]);
Route::resource('stuffs', 'StuffsController');
Route::resource('categories', 'CategoriesController');
Route::resource('debt-histories', 'DebtHistoriesController');

Route::put('/histories/create', 'HistoriesController@update');
Route::delete('/histories/create/{history}', 'HistoriesController@destroy');
Route::delete('/histories/create', 'HistoriesController@destroy');
Route::post('/histories/create', 'HistoriesController@keranjang');
Route::resource('histories', 'HistoriesController');
Route::resource('profiles', 'ProfilesController')->except([
    'create', 'store', 'destroy'
]);
Route::resource('in-transactions', 'InTransactionsController')->only([
    'index','store'
]);
//Route::post('/out-transactions/create', 'OutTransactionsController@store');

Route::delete('/out-transactions', 'OutTransactionsController@destroy');
Route::resource('out-transactions', 'OutTransactionsController');

Route::resource('reports', 'ReportsController');
Route::resource('units', 'UnitsController');

//Route::get('/', 'HomeController@index')->name('home');

//Route::get('/', 'PagesController@home');

//Auth::routes();

//manual routes for crud

//Route::get('/users', 'UsersController@index');

//Route::get('/users/create', 'UsersController@create');

//Route::get('/users/{employee}', 'UsersController@show');

//Route::post('/users', 'UsersController@store');

//Route::delete('/users/{employee}', 'UsersController@destroy');

//Route::get('/users/{employee}/edit', 'UsersController@edit');

//Route::put('/users/{employee}', 'UsersController@update');

//auto routes for crud (in conditon: it's using php artisan make:controller NameController -r -m ModelName

//Route::get('/profiles', 'ProfilesController@index');
//Route::get('/profiles/{profile}', 'ProfilesController@show');
//Route::get('/profiles/{profile}/edit', 'ProfilesController@edit');
//Route::put('/profiles/{profile}', 'ProfilesController@update');

//Route::get('/in-transactions', 'InTransactionsController@index');
//Route::put('/in-transactions', 'InTransactionsController@update');


//Route::get('/users', [
//    'middleware' => 'auth',
//    'uses' => 'UsersController@index'
//]);

//Route::get('/users/{user}', [
//    'middleware' => 'auth',
//    'uses' => 'UsersController@show'
//]);

//Route::get('/users/{user}/edit', [
//    'middleware' => 'auth',
//    'uses' => 'UsersController@edit'
//]);

//Route::get('/stuffs', [
//    'middleware' => 'auth',
//    'uses' => 'StuffsController@index'
//]);

//Route::get('/categories', [
//    'middleware' => 'auth',
//    'uses' => 'CategoriesController@index'
//]);

//Route::get('/debt-histories', [
//    'middleware' => 'auth',
//    'uses' => 'DebtHistoriesController@index'
//]);

//Route::get('/histories', [
//    'middleware' => 'auth',
//    'uses' => 'HistoriesController@index'
//]);

//Route::get('/in-transactions', [
//    'middleware' => 'auth',
//    'uses' => 'InTransactionsController@index'
//]);

//Route::get('/out-transactions', [
//    'middleware' => 'auth',
//    'uses' => 'OutTransactionsController@index'
//]);

//Route::get('/reports', [
//    'middleware' => 'auth',
//    'uses' => 'ReportsController@index'
//]);

//Route::get('/units', [
//    'middleware' => 'auth',
//    'uses' => 'UnitsController@index'
//]);

//Route::get('/profiles', [
//    'middleware' => 'auth',
//    'uses' => 'ProfilesController@index'
//]);

//Route::get('/profiles/{profile}', [
//    'middleware' => 'auth',
//    'uses' => 'ProfilesController@show'
//]);

//Route::get('/profiles/{profile}/edit', [
//    'middleware' => 'auth',
//    'uses' => 'ProfilesController@edit'
//]);

//Route::put('/profiles/{profile}', [
//    'middleware'=>'auth',
//    'uses'=>'ProfilesController@update']);

//Route::get('/register', [
//    'middleware' => 'auth',
//    'uses' => 'HomeController@index'
//]);
