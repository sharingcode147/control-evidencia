<?php

namespace App\Http\Controllers\Consultas;

use App\Evidencia;
use App\Formulario;
use Fpdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

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
        $KIN = 0;
        $PSI = 0;
        $ENFT=0;
        $ENFC=0;
        $total_ing=0;

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
                if($form->codigo_car=="KIN"){
                        $KIN=$KIN+1;
                }
                if($form->codigo_car=="PSI"){
                        $PSI=$PSI+1;
                }
                if($form->codigo_car=="ENFT"){
                        $ENFT=$ENFT+1;
                }
                if($form->codigo_car=="ENFC"){
                        $ENFC=$ENFC+1;
                }
        }

        $total_ing= $ICI+ $INC +$ICE + $IND;
        $total_med= $KIN+$PSI+$ENFT+$ENFC;
        $total=$total_ing + $total_med;
        //	Preparando los datos para enviar.
        $datos = array(
	        "ICI" => $ICI,					
	    	"INC" => $INC,
	    	"ICE" => $ICE,
	    	"IND" => $IND,
                "IND" => $IND,
                "KIN" => $KIN,
                "PSI" => $PSI,
                "ENFT" => $ENFT,
                "ENFC" => $ENFC,
            "Total_i" => $total_ing,
            "Total_m" => $total_med,
            "Total" => $total
    	);
    	//	Retornando los datos.
        return json_encode($datos);
    }
    public function generarInforme3($anio1,$anio2,$mes1,$mes2,$dia1,$dia2){
        $datos = $this->obtenerDatos1($anio1,$anio2,$mes1,$mes2,$dia1,$dia2);
        $datos = json_decode($datos);

        $rango = " ".$dia1."-".$mes1."-".$anio1." y ".$dia2."-".$mes2."-".$anio2;
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

        Fpdf::Cell(0,7,utf8_decode('Evidencias enviadas entre'.$rango),1,1,'C',FALSE);
        Fpdf::Ln(7);
        Fpdf::Cell(95,7,utf8_decode('Dep Ing.'),1,0,'C',FALSE);
        Fpdf::Cell(95,7,utf8_decode('Externos'),1,1,'C',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('Ing. Informática'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->ICI),0,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('Kinesiología'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->KIN),0,1,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('Ingeniería Civil'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->INC),0,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('Psicología'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->PSI),0,1,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('Ing. Electrónica'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->ICE),0,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('Enf. Curicó'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->ENFC),0,1,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('Ing Industial'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->IND),0,0,'L',FALSE);


        Fpdf::Cell(47.5,7,utf8_decode('Enf. Talca'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->ENFT),0,1,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('Total: '),1,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->Total_i),1,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('Total: '),1,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->Total_m),1,1,'L',FALSE);

        Fpdf::Ln(7);
        Fpdf::Cell(95,7,utf8_decode('Total Evidencias'),1,0,'C',FALSE);
        Fpdf::Cell(95,7,utf8_decode($datos->Total),1,1,'C',FALSE);
            

        


        Fpdf::Ln();       
        Fpdf::Output();
        exit;
    }
}
