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

	Route::get('formularioprofe/{id}',[
		'as' => 'formularioprofe',
		'uses' => 'HomeProfesorController@showrev'
	]);


	Route::post('images-upload', 'prueba@upload');

	//ve l evidencia aprobada
	Route::get('evidencia/{id}',[
		'as' => 'evidenciaap',
		'uses' => 'EvAprobController@showAprobadas'
	]);

	//ve la evidencia no aprobada
	Route::get('evidencia_noap/{id}',[
		'as' => 'evidencianoap',
		'uses' => 'EvNoAprobController@shownoAprobadas'
	]);

	//edita la evidencia
	Route::get('evidencia_noapedit/{id}',[
		'as' => 'edita_evnoaprob',
		'uses' => 'EditEvController@editnoAprob'
	]);
	Route::post('evidencia_noapedit',[
		'as' => 'nuevaEvidenciaEdit',
		'uses' => 'EditEvController@storeeditanoAprob'
	]);

	Route::get('pdf_evidencia_aprobada_prof/{id}','EvAprobController@pdf_evidencia_aprobada_prof')->name('pdf_prof');
});



//	Protección rutas ADMINISTRADOR
Route::group(['namespace' => 'Admin', 'middleware' => ['authAdmin','auth'], 'prefix' => 'admin'], function()
{
	Route::get('home','HomeAdminController@index')->name('adminHome');
	Route::resource('users','UsersController');
	Route::resource('users2','Users2Controller');
	Route::resource('carreras','CarrerasController');
	Route::resource('departamentos','DepController');
});
//	Protección rutas REVISOR
Route::group(['namespace' => 'Revisor', 'middleware' => ['authRevisor','auth'], 'prefix' => 'revisor'], function()
{
	Route::get('home','HomeRevisorController@index')->name('revisorHome');
	Route::get('colaRevisor','HomeRevisorController@colaRevisor')->name('colaRevisor');
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

	Route::get('pdf_evidencia_aprobada_rev/{id}','HomeRevisorController@pdf_evidencia_aprobada_rev')->name('pdf_rev');
});
//	Protección rutas DAC
Route::group(['namespace' => 'Dac', 'middleware' => ['authDac','auth'], 'prefix' => 'dac'], function()
{
	Route::get('home','HomeDacController@index')->name('dacHome');
	Route::get('colaDac','HomeDacController@colaDac')->name('colaDac');
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

	Route::get('pdf_evidencia_aprobada_dac/{id}','HomeDacController@pdf_evidencia_aprobada_dac')->name('pdf_dac');
});

//	Protección rutas CONSULTAS
Route::group(['namespace' => 'Consultas', 'middleware' => ['authConsultas','auth'], 'prefix' => 'consultas'], function()
{
	Route::get('consulta1','Consulta1@index')->name('consulta1');
	Route::get('obtenerDatos/{anio1}/{anio2}/{mes1}/{mes2}/{dia1}/{dia2}', 'Consulta1@obtenerDatos');
	Route::get('informe1/{anio1}/{anio2}/{mes1}/{mes2}/{dia1}/{dia2}','Consulta1@generarInforme1');
	
	Route::get('consulta2','Consulta2Controller@index')->name('consulta2');
	Route::get('obtenerDatos2', 'Consulta2Controller@obtenerDatoss');
	Route::get('informe2','Consulta2Controller@generarInforme2')->name('informe2');

	Route::get('consulta3','consulta3Controller@index')->name('consulta3');
	Route::get('obtenerDatos1/{anio1}/{anio2}/{mes1}/{mes2}/{dia1}/{dia2}', 'consulta3Controller@obtenerDatos1');
	Route::get('informe3/{anio1}/{anio2}/{mes1}/{mes2}/{dia1}/{dia2}','consulta3Controller@generarInforme3');

	Route::get('consulta4','Consulta4Controller@index')->name('consulta4');
	Route::get('PendientesCarrera', 'Consulta4Controller@consultaPendientes');
	Route::get('informepen', 'Consulta4Controller@generarInforme4')->name('informepen');

	Route::get('consulta5','Consulta5Controller@index')->name('consulta5');
	Route::get('ObserCarreras','Consulta5Controller@consultaobse');

	Route::get('consulta6','Consulta6Controller@index')->name('consulta6');
	Route::get('GrafAlcance','Consulta6Controller@consulalcance');

	Route::get('consulta7','Consulta7Controller@index')->name('consulta7');
	Route::get('grafambito','Consulta7Controller@consultambito');
	Route::get('informe7','Consulta7Controller@generarInforme7');

	Route::get('consulta8','Consulta8Controller@index')->name('consulta8');
	Route::get('grafmes','Consulta8Controller@consulmes');
	Route::get('informe8','Consulta8Controller@generarInforme8');


});

