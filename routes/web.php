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
	Route::get('nuevaevidencia', 'NuevEvController@get_carreras')->name('get_carreras');
	Route::post('nuevaevidenciasdd', 'NuevEvController@nuevaEvidenciast')->name('nuevaEvidenciast');
	Route::get('evidenciasaprobadas','EvAprobController@index')->name('evaprobadas');
	Route::get('evidenciasnoaprobadas','EvNoAprobController@index')->name('evnoaprobadas');

	Route::get('evidenciasCursoRevisor', 'HomeProfesorController@EvidenciaRevisor')->name('evidenciasC_revisor');
	Route::get('evidenciasCursoDac', 'HomeProfesorController@EvidenciaDac')->name('evidenciasC_Dac');
});

Route::post('/images-upload', 'prueba@upload');

//	Protección rutas ADMINISTRADOR
Route::group(['namespace' => 'Admin', 'middleware' => ['authAdmin','auth'], 'prefix' => 'admin'], function()
{
	Route::get('home','HomeAdminController@index')->name('adminHome');
});
//	Protección rutas REVISOR
Route::group(['namespace' => 'Revisor', 'middleware' => ['authRevisor','auth'], 'prefix' => 'revisor'], function()
{
	Route::get('home','HomeRevisorController@index')->name('revisorHome');
	Route::get('evidenciasaprobadas','HomeRevisorController@getAp')->name('revaprobadas');
	Route::get('evidenciasnoaprobadas','HomeRevisorController@getNoAp')->name('revnoaprobadas');
	Route::get('evidenciasenvdac','HomeRevisorController@enviadasDAC')->name('evenviadas');
	Route::get('evidencia/{id}',[
		'as' => 'evidencia',
		'uses' => 'HomeRevisorController@showAprobadas'
	]);
});
//	Protección rutas DAC
Route::group(['namespace' => 'Dac', 'middleware' => ['authDac','auth'], 'prefix' => 'dac'], function()
{
	Route::get('home','HomeDacController@index')->name('dacHome');
	Route::get('formularioDac/{id}',[
		'as' => 'formularioDac-show',
		'uses' => 'HomeDacController@show'
	]);
});



