<?php

namespace App\Http\Controllers\Consultas;

use App\Evidencia;
use App\Formulario;
use App\Observaciones;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Carbon;
use Fpdf;



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
        $TOTA = 0;

  
    	//	Recorriendo la respuesta.
        foreach($alc as $form){
        	//	Sumando las evidencias por alcance.
            $TOTA=$TOTA + 1;                  
        	
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
            "TOTA" => $TOTA
        );
    	//	Retornando los datos.
        return json_encode($datos);
    }

        public function generarInforme6(){
        $datos = $this->consulalcance();
        $datos = json_decode($datos);
        
        Fpdf::AddPage();

        Fpdf::Image('img/logo_ucm_color.png',10,8,40);
        Fpdf::Image('img/logo_dac.png',160,8,40);
        Fpdf::SetFont('Arial','B',13);
        Fpdf::Cell(30);
        Fpdf::Cell(120,10,utf8_decode('Universidad Católica del Maule'),0,0,'C');
        Fpdf::Ln('5');
        Fpdf::SetFont('Arial','B',8);
        Fpdf::Cell(30);
        Fpdf::Cell(120,10,utf8_decode('Departamento de Aseguramiento de la Calidad'),0,0,'C');
        Fpdf::Ln(20);

        Fpdf::SetFont('Arial','B',13);
        Fpdf::Cell(175,10,utf8_decode('Documento del Sistema de Gestión de Calidad'),0,0,'C');
        Fpdf::Ln(5);
        Fpdf::SetFont('Arial','B',11);
        Fpdf::Cell(180,10,utf8_decode('Registros del Sistema de Gestión de Calidad'),0,0,'C');
        Fpdf::Ln(5);
        Fpdf::Cell(180,10,utf8_decode('Identificación de Registros'),0,0,'C');
        Fpdf::Ln(15);

        Fpdf::Cell(0,7,utf8_decode('Cantidad de Evidencias por Alcance'),1,1,'C',FALSE);
        Fpdf::Ln(7);
        Fpdf::Cell(95,7,utf8_decode('Alcance'),1,0,'C',FALSE);
        Fpdf::Cell(95,7,utf8_decode('Cantidad de Evidencias'),1,1,'C',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode('COMUNAL'),0,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->COM),0,1,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode(' '),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode('PROVINCIAL'),0,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode(' '),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->PROV),0,1,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode(' '),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode('REGIONAL'),0,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode(' '),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->REG),0,1,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode(' '),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode('NACIONAL'),0,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode(' '),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->NAC),0,1,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode(' '),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode('INTERNACIONAL'),0,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode(' '),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->INT),0,1,'L',FALSE);

        Fpdf::Ln(3);
        Fpdf::Cell(95,7,utf8_decode('Total evidencias'),1,0,'C',FALSE);
        Fpdf::Cell(95,7,utf8_decode($datos->TOTA),1,1,'C',FALSE);
        Fpdf::Ln(7);
        Fpdf::Cell(190,7,utf8_decode('*Elaborado en base a un total de '.$datos->TOTA.' evidencias.'),0,1,'L',FALSE);
        Fpdf::Ln();      

        $fecha_actual = new Carbon;

        Fpdf::Output('I',"informe_6_".$fecha_actual);
        exit;
    }
}
