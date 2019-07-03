<?php

namespace App\Http\Controllers\Consultas;

use App\Evidencia;
use App\Formulario;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Consulta4Controller extends Controller
{
    //
    public function index(){
    	return view('consultas.consulta4');
    }
    public function consultaPendientes(){
        //	Obteniendo el número de asistentes en el rango de fechas.
        //	Consultando los formularios en el rango de fechas.
        $cpendiente = Evidencia::all();
        //	Inicializando en 0 en caso de no tener resultados.
        $ICI = 0;					
    	$INC = 0; 
    	$ICE = 0;
    	$IND = 0;
        $FICI = 0;                   
        $FINC = 0; 
        $FICE = 0;
        $FIND = 0;
        

    	//	Recorriendo la respuesta.
        foreach($cpendiente as $form){
        	//	Sumando los participantes internos.
            if($form->estado=="Pendiente"){
                
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
            if($form->estado=="Finalizada"){
                
                if($form->codigo_car=="ICI"){
                    $FICI=$FICI+1;
                }
                if($form->codigo_car=="INC"){
                    $FINC=$FINC+1;
                }
                if($form->codigo_car=="ICE"){
                    $FICE=$FICE+1;
                }
                if($form->codigo_car=="IND"){
                    $FIND=$FIND+1;
                }
            }
        }

        //	Preparando los datos para enviar.
        $datos = array(
	        "ICI" => $ICI,					
	    	"INC" => $INC,
	    	"ICE" => $ICE,
	    	"IND" => $IND,
            "FICI" => $FICI,                  
            "FINC" => $FINC,
            "FICE" => $FICE,
            "FIND" => $FIND
    	);
    	//	Retornando los datos.
        return json_encode($datos);
    }
}
