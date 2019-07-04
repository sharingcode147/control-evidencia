<?php

namespace App\Http\Controllers\Consultas;

use App\Evidencia;
use App\Formulario;
use App\Observaciones;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Consulta7Controller extends Controller
{
    //
    public function index(){
    	return view('consultas.consulta7');
    }
    public function consultambito(){
        //	Obteniendo el número de asistentes en el rango de fechas.
        //	Consultando codigo carrera de observaciones.
        $alc = DB::table('formularios')
                            ->select('formularios.ambito_id')
                            ->join('evidencias','formularios.id','=','evidencias.formulario_id')
                            ->get();
        $ACA = 0;					
    	$EXT = 0; 
    	$EAC = 0;
    	$GES= 0;
        $INV = 0; 
        $PROD = 0;
        $SOC = 0;   
    	//	Recorriendo la respuesta.
        foreach($alc as $form){
        	//	Sumando los participantes internos.              
        	if($form->ambito_id== 1){
        		$ACA=$ACA+1;
        	}
        	if($form->ambito_id== 2){
        		$EXT=$EXT+1;
        	}
        	if($form->ambito_id== 3){
        		$EAC=$EAC+1;
        	}
        	if($form->ambito_id== 4){
        		$GES=$GES+1;
        	}
            if($form->ambito_id== 5){
                $INV=$INV+1;
            }
            if($form->ambito_id== 6){
                $PROD=$PROD+1;
            }
            if($form->ambito_id== 7){
                $SOC=$SOC+1;
            }
        }

        //	Preparando los datos para enviar.
        $datos = array(
	        "ACA" => $ACA,					
	    	"EXT" => $EXT,
	    	"EAC" => $EAC,
	    	"GES" => $GES,
    	    "INV" => $INV,
    	    "PROD" => $PROD,
    	    "SOC" => $SOC
        );
    	//	Retornando los datos.
        return json_encode($datos);
    }
}
