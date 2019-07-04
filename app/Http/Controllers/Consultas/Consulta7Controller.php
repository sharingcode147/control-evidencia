<?php

namespace App\Http\Controllers\Consultas;

use App\Evidencia;
use App\Formulario;
use App\Observaciones;
use Fpdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

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
        $Total=0;   
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
        $Total=$ACA+$EXT+$EAC+$GES+$INV+$PROD+$SOC;

        //	Preparando los datos para enviar.
        $datos = array(
	        "ACA" => $ACA,					
	    	"EXT" => $EXT,
	    	"EAC" => $EAC,
	    	"GES" => $GES,
    	    "INV" => $INV,
    	    "PROD" => $PROD,
    	    "SOC" => $SOC,
            "Total"=> $Total
        );
    	//	Retornando los datos.
        return json_encode($datos);
    }
    public function generarInforme7(){
        $datos = $this->consultambito();
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

        Fpdf::Cell(0,7,utf8_decode('Titulo:Numero de evidencias según ambito                      Fecha de Emision:' .$fecha_actual),1,1,'C',FALSE);
        Fpdf::Ln(7);
        Fpdf::Cell(95,7,utf8_decode('Ambito'),1,0,'C',FALSE);
        Fpdf::Cell(95,7,utf8_decode('  Total '),1,0,'C',FALSE);

        Fpdf::Ln(7);
       
        Fpdf::Cell(47.5,7,utf8_decode('Académico'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->ACA),0,1,'L',FALSE);
        
        Fpdf::Cell(47.5,7,utf8_decode('Extención'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->EXT),0,1,'L',FALSE);
        
        Fpdf::Cell(47.5,7,utf8_decode('Ext. Académica'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->EAC),0,1,'L',FALSE);
       
        Fpdf::Cell(47.5,7,utf8_decode('Gestión'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->GES),0,1,'L',FALSE);
    
        Fpdf::Cell(47.5,7,utf8_decode('Investigación'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->INV),0,1,'L',FALSE);

        
        Fpdf::Cell(47.5,7,utf8_decode('Productivo'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->PROD),0,1,'L',FALSE);
       
        Fpdf::Cell(47.5,7,utf8_decode('Social'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode(''),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->SOC),0,1,'L',FALSE);

       
        Fpdf::Cell(95,7,utf8_decode('Total Evidencias por ambito'),1,0,'C',FALSE);
        Fpdf::Cell(95,7,utf8_decode($datos->Total),1,1,'C',FALSE);
            

        


        Fpdf::Ln();       
        Fpdf::Output();
        exit;
    }
}
