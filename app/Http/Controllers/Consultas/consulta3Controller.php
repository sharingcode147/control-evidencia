<?php

namespace App\Http\Controllers\Consultas;

use App\Evidencia;
use App\Formulario;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class consulta3Controller extends Controller
{
    //
    public function index(){
    	return view('consultas.consulta3');
    }
    public function obtenerDatos1($anio1,$anio2,$mes1,$mes2,$dia1,$dia2){
        //	Obteniendo el número de asistentes en el rango de fechas.

        //	Dando formato a las fechas.
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio1."-".$mes1."-".$dia1) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio2."-".$mes2."-".$dia2) );
        
        //	Consultando los formularios en el rango de fechas.
        $formularios = Evidencia::whereBetween('formularios.fecha_realizacion', [$fecha_inicial,  $fecha_final])
        						    ->join('formularios','evidencias.formulario_id','=','formularios.id')
        						    ->get();
        //	Inicializando en 0 en caso de no tener resultados.
        $ICI = 0;					
    	$INC = 0; 
    	$ICE = 0;
    	$IND = 0;

    	//	Recorriendo la respuesta.
        foreach($formularios as $form){
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
	    	"IND" => $IND
    	);
    	//	Retornando los datos.
        return json_encode($datos);
    }
}
