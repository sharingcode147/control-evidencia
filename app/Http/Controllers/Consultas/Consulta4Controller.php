<?php

namespace App\Http\Controllers\Consultas;

use App\Evidencia;
use App\Formulario;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Carbon;
use Fpdf;


class Consulta4Controller extends Controller
{
    //
    public function index(){
    	return view('consultas.consulta4');
    }
    public function consultaPendientes(){
        //consultando evidencias disponibles
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
        	//	Sumando las evidencias pendientes.
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
            //Sumando evidencias Finalizadas
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
        //Calculando Totales
        $TOTP = $ICI+$INC+$ICE+$IND;
        $TOTF = $FICI+$FINC+$FICE+$FIND;
        $TOT = $TOTP + $TOTF;
        //	Preparando los datos para enviar.
        $datos = array(
	        "ICI" => $ICI,					
	    	"INC" => $INC,
	    	"ICE" => $ICE,
	    	"IND" => $IND,
            "FICI" => $FICI,                  
            "FINC" => $FINC,
            "FICE" => $FICE,
            "FIND" => $FIND,
            "TOTP" => $TOTP,
            "TOTF" => $TOTF,
            "TOT" => $TOT
    	);
    	//	Retornando los datos.
        return json_encode($datos);
    }

    public function generarInforme4(){
        $datos = $this->consultaPendientes();
        $datos = json_decode($datos);
        dd($datos);
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

        Fpdf::Cell(0,7,utf8_decode('Cantidad de Evidencias Pendientes y Finalizadas por Carrera'),1,1,'C',FALSE);
        Fpdf::Ln(7);
        Fpdf::Cell(95,7,utf8_decode('Pendientes'),1,0,'C',FALSE);
        Fpdf::Cell(95,7,utf8_decode('Finalizadas'),1,1,'C',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('ICI'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->ICI),0,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('ICI'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->FICI),0,1,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('IND'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->IND),0,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('IND'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->FIND),0,1,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('INC'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->INC),0,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('INC'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->FINC),0,1,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('ICE'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->ICE),0,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('ICE'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->FICE),0,1,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('Total: '),1,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->TOTP),1,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('Total: '),1,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->TOTF),1,1,'L',FALSE);

        Fpdf::Ln(7);
        Fpdf::Cell(95,7,utf8_decode('Total evidencias'),1,0,'C',FALSE);
        Fpdf::Cell(95,7,utf8_decode($datos->TOT),1,1,'C',FALSE);
        Fpdf::Ln(7);
        Fpdf::Cell(190,7,utf8_decode('*Elaborado en base a un total de '.$datos->TOT.' evidencias.'),0,1,'L',FALSE);
        Fpdf::Ln();      

        $fecha_actual = new Carbon;

        Fpdf::Output('I',"informe_4_".$fecha_actual);
        exit;
    }
}
