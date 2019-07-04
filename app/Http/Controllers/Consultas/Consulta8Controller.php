<?php

namespace App\Http\Controllers\Consultas;

use App\Evidencia;
use App\Formulario;
use App\Observaciones;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Consulta8Controller extends Controller
{
    //
    public function index(){
    	return view('consultas.consulta8');
    }
    public function consulmes(){
        //	Obteniendo el número de asistentes en el rango de fechas.
        //	Consultando codigo carrera de observaciones.
        $alc = DB::table('profesor_carrera')
                            ->get();

        $ICI = 0;					
    	$EICI = 0; 
    	$ICE = 0;
    	$IND= 0;
        $ICO = 0; 
        $INC = 0;
        $KIN = 0;   
    	//	Recorriendo la respuesta.
        foreach($alc as $form){
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
        	if($form->codigo_car=="ICO"){
        		$IC0=$IC0+1;
        	}
        	if($form->codigo_car=="EICI"){
        		$EICI=$EICI+1;
        	}
        	if($form->codigo_car=="KIN"){
        		$KIN=$KIN+1;
        	}

        }
        $total= $ICI+ $INC +$ICE + $IND +$KIN+$ICO+$EICI;

        //	Preparando los datos para enviar.
        $datos = array(
	        "ICI" => $ICI,					
	    	"INC" => $INC,
	    	"ICE" => $ICE,
	    	"IND" => $IND,
	    	"ICO" => $ICO,
	    	"EICI" => $EICI,
	    	"KIN" => $KIN,
	    	"Total" => $total
        );
    	//	Retornando los datos.
        return json_encode($datos);
    }
}
