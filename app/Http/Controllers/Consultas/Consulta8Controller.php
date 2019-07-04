<?php

namespace App\Http\Controllers\Consultas;

use App\Evidencia;
use App\Formulario;
use App\Observaciones;
use Fpdf;
use Illuminate\Support\Carbon;
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
    public function generarInforme8(){
        $datos = $this->consulmes();
        $datos = json_decode($datos);
        $fecha_actual = new Carbon;
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

        Fpdf::Cell(0,7,utf8_decode('Titulo:Canatidad de profesores por carrera                              Fecha de Emision:' .$fecha_actual),1,1,'C',FALSE);
        Fpdf::Ln(7);
        Fpdf::Cell(95,7,utf8_decode('Carreras'),1,0,'C',FALSE);
        Fpdf::Cell(95,7,utf8_decode('  Total '),1,0,'C',FALSE);
        Fpdf::Ln(7);
        Fpdf::Cell(47.5,7,utf8_decode('Ing. Informática'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
    	Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->ICI),0,1,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode('Ingeniería Civil'),0,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->INC),0,1,'L',FALSE);
        
        Fpdf::Cell(47.5,7,utf8_decode('Ing. Electrónica'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->ICE),0,1,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode('Ing. Industial'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->IND),0,1,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode('Ing. Construcción'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->ICO),0,1,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode('Ing. Computación'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->EICI),0,1,'L',FALSE);
        
        Fpdf::Cell(47.5,7,utf8_decode('Kinesiología'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->KIN),0,0,'L',FALSE);

        
        Fpdf::Ln(7);
        Fpdf::Ln(7);
        Fpdf::Cell(95,7,utf8_decode('Total Evidencias por ambito'),1,0,'C',FALSE);
        Fpdf::Cell(95,7,utf8_decode($datos->Total),1,1,'C',FALSE);
            

        


        Fpdf::Ln();       
        Fpdf::Output();
        exit;
    }
}
