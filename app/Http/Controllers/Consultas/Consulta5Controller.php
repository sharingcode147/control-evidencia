<?php

namespace App\Http\Controllers\Consultas;

use App\Evidencia;
use App\Formulario;
use App\Observaciones;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class Consulta5Controller extends Controller
{
    //
    public function index(){
    	return view('consultas.consulta5');
    }
    public function consultaobse(){
        //	Obteniendo el número de asistentes en el rango de fechas.
        //	Consultando cod  carrera de observaciones.
        $obs = DB::table('evidencias')
                            ->select('evidencias.codigo_car')
                            ->join('observaciones','evidencias.id','=','observaciones.evidencia_id')
                            ->get();
        $ICI = 0;					
    	$INC = 0; 
    	$ICE = 0;
    	$IND = 0;    
    	//	Recorriendo la respuesta.
        foreach($obs as $form){
        	//	Sumando los participantes internos.              
        	if($form->codigo_car=="ICI"){
        		$ICI=$ICI+1;
        	}
        	if($form->codigo_car=="INC"){
        		$INC=$INC+1;
        	}
        	if($form->codigo_car=="ICE"){
        		$ICE=$ICE+1;
        	}
        	if($form->codigo_car=="IND"){
        		$IND=$IND+1;
        	}
        }

        //	Preparando los datos para enviar.
        $datos = array(
	        "ICI" => $ICI,					
	    	"INC" => $INC,
	    	"ICE" => $ICE,
	    	"IND" => $IND,
    	);
    	//	Retornando los datos.
        return json_encode($datos);
    }
}
