<?php

namespace App\Http\Controllers\Consultas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Evidencia;
use App\Formulario;

use Illuminate\Support\Carbon;
use Fpdf;

class Consulta1 extends Controller
{

    public function index(){
    	//	Abriendo la vista principal.
        return view('consultas.consulta1');
    }

    public function obtenerDatos($anio1,$anio2,$mes1,$mes2,$dia1,$dia2){
        //	Obteniendo el número de asistentes en el rango de fechas.

        //	Dando formato a las fechas.
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio1."-".$mes1."-".$dia1) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio2."-".$mes2."-".$dia2) );
        
        //	Consultando los formularios en el rango de fechas.
        $formularios = Formulario::whereBetween('fecha_realizacion', [$fecha_inicial,  $fecha_final])->get();

        //	Inicializando en 0 en caso de no tener resultados.
        $int_profesores = 0;					
    	$int_profesionales = 0; 
    	$int_estudiantes = 0;
    	$int_autoridades = 0;
    	$ext_profesores = 0;
    	$ext_profesionales = 0; 
    	$ext_estudiantes = 0;
    	$ext_autoridades = 0;

        $total_int = 0;
        $total_ext = 0;
        $total = 0;
        $cantidad = 0;

    	//	Recorriendo la respuesta.
        foreach($formularios as $form){
        	//	Sumando los participantes internos.
	    	$int_profesores = $int_profesores + $form->int_profesores;
	    	$int_profesionales = $int_profesionales + $form->int_profesionales;
	    	$int_estudiantes = $int_estudiantes + $form->int_estudiantes;
	    	$int_autoridades = $int_autoridades + $form->int_autoridades;

	    	//	Sumando los participantes externos.
	    	$ext_profesores = $ext_profesores + $form->ext_profesores;
	    	$ext_profesionales = $ext_profesionales + $form->ext_profesionales;
	    	$ext_estudiantes = $ext_estudiantes + $form->ext_estudiantes;
	    	$ext_autoridades = $ext_autoridades + $form->ext_autoridades;

            $cantidad++;
        }

        //  Calculando totales.
        $total_int = $int_profesores + $int_profesionales + $int_estudiantes + $int_autoridades;
        $total_ext = $ext_profesores + $ext_profesionales + $ext_estudiantes + $ext_autoridades;
        $total = $total_int + $total_ext;

        //	Preparando los datos para enviar.
        $datos = array(
	        "int_profesores" => $int_profesores,					
	    	"int_profesionales" => $int_profesionales,
	    	"int_estudiantes" => $int_estudiantes,
	    	"int_autoridades" => $int_autoridades,
	    	"ext_profesores" => $ext_profesores,
	    	"ext_profesionales" => $ext_profesionales,
	    	"ext_estudiantes" => $ext_estudiantes,
	    	"ext_autoridades" => $ext_autoridades,
            "total_int" => $total_int,
            "total_ext" => $total_ext,
            "total" => $total,
            "cantidad" => $cantidad
    	);
    	//	Retornando los datos.
        return json_encode($datos);
    }

    public function generarInforme1($anio1,$anio2,$mes1,$mes2,$dia1,$dia2){
        $datos = $this->obtenerDatos($anio1,$anio2,$mes1,$mes2,$dia1,$dia2);
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

        Fpdf::Cell(0,7,utf8_decode('Asistentes internos/externos entre'.$rango),1,1,'C',FALSE);
        Fpdf::Ln(7);
        Fpdf::Cell(95,7,utf8_decode('Internos'),1,0,'C',FALSE);
        Fpdf::Cell(95,7,utf8_decode('Externos'),1,1,'C',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('Autoridades'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->int_autoridades),0,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('Autoridades'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->ext_autoridades),0,1,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('Estudiantes'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->int_estudiantes),0,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('Estudiantes'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->ext_estudiantes),0,1,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('Profesionales'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->int_profesionales),0,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('Profesionales'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->ext_profesionales),0,1,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('Profesores'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->int_profesores),0,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('Profesores'),0,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->ext_profesores),0,1,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('Total: '),1,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->total_int),1,0,'L',FALSE);

        Fpdf::Cell(47.5,7,utf8_decode('Total: '),1,0,'L',FALSE);
        Fpdf::Cell(47.5,7,utf8_decode($datos->total_ext),1,1,'L',FALSE);

        Fpdf::Ln(7);
        Fpdf::Cell(95,7,utf8_decode('Total asistentes'),1,0,'C',FALSE);
        Fpdf::Cell(95,7,utf8_decode($datos->total),1,1,'C',FALSE);
        Fpdf::Ln(7);
        Fpdf::Cell(190,7,utf8_decode('*Elaborado en base a un total de '.$datos->cantidad.' evidencias.'),0,1,'L',FALSE);
        Fpdf::Ln();      

        $fecha_actual = new Carbon;

        Fpdf::Output('I',"informe_1_".$fecha_actual);
        exit;
    }
}
