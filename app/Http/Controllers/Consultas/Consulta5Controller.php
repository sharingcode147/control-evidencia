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


class Consulta5Controller extends Controller
{
    //
    public function index(){
    	return view('consultas.consulta5');
    }
    public function consultaobse(){
        //	Obteniendo el número de asistentes en el rango de fechas.
        //	Consultando codigo carrera de observaciones.
        $obs = DB::table('evidencias')
                            ->select('evidencias.codigo_car')
                            ->join('observaciones','evidencias.id','=','observaciones.evidencia_id')
                            ->get();
        $evis= Evidencia::all();
        $ICI = 0;					
    	$INC = 0; 
    	$ICE = 0;
    	$IND = 0;
        $TOTC = 0;   
        $TOTE = 0;
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
            $TOTC = $TOTC + 1;
        }
        //Calculando Totales
        foreach($evis as $ev){
            $TOTE = $TOTE + 1;
        }


        //	Preparando los datos para enviar.
        $datos = array(
	        "ICI" => $ICI,					
	    	"INC" => $INC,
	    	"ICE" => $ICE,
	    	"IND" => $IND,
            "TOTC" => $TOTC,
            "TOTE" => $TOTE
    	);
    	//	Retornando los datos.
        return json_encode($datos);
    }
    public function generarInforme5(){
        $datos = $this->consultaobse();
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

        Fpdf::Cell(0,7,utf8_decode('Cantidad de Observaciones por Carrera'),1,1,'C',FALSE);
        Fpdf::Ln(7);
        Fpdf::Cell(95,7,utf8_decode('Carrera'),1,0,'C',FALSE);
        Fpdf::Cell(95,7,utf8_decode('Cantidad'),1,1,'C',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode('ICI'),0,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->ICI),0,1,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode(' '),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode('IND'),0,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode(' '),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->IND),0,1,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode(' '),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode('INC'),0,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode(' '),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->INC),0,1,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode(' '),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode('ICE'),0,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode(' '),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->ICE),0,1,'L',FALSE);

        Fpdf::Ln(3);
        Fpdf::Cell(95,7,utf8_decode('Total Comentarios'),1,0,'C',FALSE);
        Fpdf::Cell(95,7,utf8_decode($datos->TOTC),1,1,'C',FALSE);
        Fpdf::Ln(7);
        Fpdf::Cell(190,7,utf8_decode('*Elaborado en base a un total de '.$datos->TOTE.' evidencias.'),0,1,'L',FALSE);
        Fpdf::Ln();      

        $fecha_actual = new Carbon;

        Fpdf::Output('I',"informe_5_".$fecha_actual);
        exit;
    }
}
