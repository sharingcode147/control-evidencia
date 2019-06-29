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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    return view('home');
})->middleware('guest');
Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('guest');

//	Protección rutas PROFESOR
Route::group(['namespace' => 'Profesor', 'middleware' => ['authProf','auth'], 'prefix' => 'profesor'], function()
{
	Route::get('home','HomeProfesorController@index')->name('profeHome');
});
//	Protección rutas ADMINISTRADOR
Route::group(['namespace' => 'Admin', 'middleware' => ['authAdmin','auth'], 'prefix' => 'admin'], function()
{
	Route::get('home','HomeAdminController@index')->name('adminHome');
});
//	Protección rutas REVISOR
Route::group(['namespace' => 'Revisor', 'middleware' => ['authRevisor','auth'], 'prefix' => 'revisor'], function()
{
	Route::get('home','HomeRevisorController@index')->name('revisorHome');
});
//	Protección rutas DAC
Route::group(['namespace' => 'Dac', 'middleware' => ['authDac','auth'], 'prefix' => 'dac'], function()
{
	Route::get('home','HomeDacController@index')->name('dacHome');
});



