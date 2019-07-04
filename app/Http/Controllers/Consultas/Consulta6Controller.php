<?php

namespace App\Http\Controllers\Consultas;

use App\Evidencia;
use App\Formulario;
use App\Observaciones;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class Consulta6Controller extends Controller
{
    //
    public function index(){
    	return view('consultas.consulta6');
    }
    public function consulalcance(){
        //	Obteniendo el número de asistentes en el rango de fechas.
        //	Consultando codigo carrera de observaciones.
        $alc = DB::table('formularios')
                            ->select('formularios.alcance_id')
                            ->join('evidencias','formularios.id','=','evidencias.formulario_id')
                            ->get();
        $COM = 0;					
    	$PROV = 0; 
    	$REG = 0;
    	$NAC= 0;
        $INT = 0;    
    	//	Recorriendo la respuesta.
        foreach($alc as $form){
        	//	Sumando los participantes internos.              
        	if($form->alcance_id== 1){
        		$COM=$COM+1;
        	}
        	if($form->alcance_id== 2){
        		$PROV=$PROV+1;
        	}
        	if($form->alcance_id== 3){
        		$REG=$REG+1;
        	}
        	if($form->alcance_id== 4){
        		$NAC=$NAC+1;
        	}
            if($form->alcance_id== 5){
                $INT=$INT+1;
            }
        }

        //	Preparando los datos para enviar.
        $datos = array(
	        "COM" => $COM,					
	    	"PROV" => $PROV,
	    	"REG" => $REG,
	    	"NAC" => $NAC,
    	    "INT" => $INT,
        );
    	//	Retornando los datos.
        return json_encode($datos);
    }
}
