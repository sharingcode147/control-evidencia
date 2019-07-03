<?php

namespace App\Http\Controllers\Consultas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Evidencia;
use App\Formulario;
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
        }

        //	Preparando los datos para enviar.
        $datos = array(
	        "int_profesores" => $int_profesores,					
	    	"int_profesionales" => $int_profesionales,
	    	"int_estudiantes" => $int_estudiantes,
	    	"int_autoridades" => $int_autoridades,
	    	"ext_profesores" => $ext_profesores,
	    	"ext_profesionales" => $ext_profesionales,
	    	"ext_estudiantes" => $ext_estudiantes,
	    	"ext_autoridades" => $ext_autoridades

    	);
    	//	Retornando los datos.
        return json_encode($datos);
    }

    public function generarInforme1(){

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
        Fpdf::Ln();
        
       
        Fpdf::Output();
        exit;

    }
}
