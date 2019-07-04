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
    return view('auth/login');
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

	Route::post('images-upload', 'prueba@upload');
});



//	Protección rutas ADMINISTRADOR
Route::group(['namespace' => 'Admin', 'middleware' => ['authAdmin','auth'], 'prefix' => 'admin'], function()
{
	Route::get('home','HomeAdminController@index')->name('adminHome');
	Route::resource('users','UsersController');
	Route::resource('users2','Users2Controller');
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
	Route::get('formularioEvidencia/{id}',[
		'as' => 'formularioEvidencia-show',
		'uses' => 'HomeRevisorController@show'
	]);
	Route::get('/aprobarEvidenciaRevisor/{id}',[
		'as' => 'aprobarEvidenciaRevisor',
		'uses' => 'HomeRevisorController@aprobarEvidenciaRevisor'
	]);
	Route::post('/observacionRevisor/{id}',[
		'as' => 'observacionRevisor',
		'uses' => 'HomeRevisorController@observacionRevisor'
	]);
});
//	Protección rutas DAC
Route::group(['namespace' => 'Dac', 'middleware' => ['authDac','auth'], 'prefix' => 'dac'], function()
{
	Route::get('home','HomeDacController@index')->name('dacHome');

	Route::get('evidenciasaprobadasdac','EvAprobadasDacController@index')->name('evaprobadasdac');
	Route::get('evidenciadac/{id}','EvAprobadasDacController@showAprobadasDac')->name('evidenciaaprobdac');
	Route::get('formularioDac/{id}',[
		'as' => 'formularioDac-show',
		'uses' => 'HomeDacController@show'
	]);

	Route::get('evidenciaFormulario/{id}',[
		'as' => 'evidenciaHisAprobada',
		'uses' => 'HomeDacController@showHisAprob'
	]);

	Route::get('/aprobarEvidenciaDac/{id}',[
		'as' => 'aprobarEvidenciaDac',
		'uses' => 'HomeDacController@aprobarEvidenciaDac'
	]);
	Route::post('/observacionDac/{id}',[
		'as' => 'observacionDac',
		'uses' => 'HomeDacController@observacionDac'
	]);
});

//	Protección rutas CONSULTAS
Route::group(['namespace' => 'Consultas', 'middleware' => ['authConsultas','auth'], 'prefix' => 'consultas'], function()
{
	Route::get('consulta1','Consulta1@index')->name('consulta1');
	Route::get('obtenerDatos/{anio1}/{anio2}/{mes1}/{mes2}/{dia1}/{dia2}', 'Consulta1@obtenerDatos');
	Route::get('informe1/{anio1}/{anio2}/{mes1}/{mes2}/{dia1}/{dia2}','Consulta1@generarInforme1');
	
	Route::get('consulta2','Consulta2Controller@index')->name('consulta2');
	Route::get('obtenerDatos2', 'Consulta2Controller@obtenerDatoss');
	Route::get('informe2','Consulta2Controller@generarInforme2');

	Route::get('consulta3','consulta3Controller@index')->name('consulta3');
	Route::get('obtenerDatos1/{anio1}/{anio2}/{mes1}/{mes2}/{dia1}/{dia2}', 'consulta3Controller@obtenerDatos1');

	Route::get('consulta4','Consulta4Controller@index')->name('consulta4');
	Route::get('PendientesCarrera', 'Consulta4Controller@consultaPendientes');

	Route::get('consulta5','Consulta5Controller@index')->name('consulta5');
	Route::get('ObserCarreras','Consulta5Controller@consultaobse');

	Route::get('consulta6','Consulta6Controller@index')->name('consulta6');
	Route::get('GrafAlcance','Consulta6Controller@consulalcance');



});

