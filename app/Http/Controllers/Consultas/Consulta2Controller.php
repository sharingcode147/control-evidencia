<?php

namespace App\Http\Controllers\consultas;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Evidencia;

class Consulta2Controller extends Controller
{
	 public function index(){
    	$evidencias = DB::table('evidencias')
    							->join('profesor','evidencias.user_id','=','profesor.user_id')
    							->select(DB::raw('evidencias.user_id, run, count(*) as num_ev,nombre1, nombre2, apellido1, apellido2'))
								->groupBy('evidencias.user_id','run','nombre1','nombre2','apellido1','apellido2')
                                ->get();
		return view('consultas.consulta2',["evidencias"=>$evidencias]);   
    }

}
