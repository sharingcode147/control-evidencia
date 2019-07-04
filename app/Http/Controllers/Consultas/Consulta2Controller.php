<?php

namespace App\Http\Controllers\consultas;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Evidencia;

use Illuminate\Support\Carbon;
use Fpdf;

class Consulta2Controller extends Controller
{
	 public function index(){

		$evidencias = DB::table('evidencias')
										->join('profesor','evidencias.user_id','=','profesor.user_id')
										->select(DB::raw('evidencias.user_id, run, count(*) as num_ev,nombre1, nombre2, apellido1, apellido2'))
										->groupBy('evidencias.user_id','run','nombre1','nombre2','apellido1','apellido2')
										->get();

		$dato = DB::table('evidencias')
								->join('profesor','evidencias.user_id','=','profesor.user_id')
								->select(DB::raw('run, count(*) as num_ev'))
								->groupBy('evidencias.user_id','run')
								->get();
		return view('consultas.consulta2',["evidencias"=>$evidencias,"dato"=>$dato]);     
	}

	public function obtenerDatoss(){
		$dato = DB::table('evidencias')
								->join('profesor','evidencias.user_id','=','profesor.user_id')
								->select(DB::raw('run, count(*) as num_ev'))
								->groupBy('evidencias.user_id','run')
								->get();

		return json_encode($dato);

	}


	public function generarInforme2(){
		$datos = DB::table('evidencias')
										->join('profesor','evidencias.user_id','=','profesor.user_id')
										->select(DB::raw('evidencias.user_id, run, count(*) as num_ev,nombre1, nombre2, apellido1, apellido2'))
										->groupBy('evidencias.user_id','run','nombre1','nombre2','apellido1','apellido2')
										->orderBy('num_ev','desc')
										->limit(5)
										->get();

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

		Fpdf::Cell(0,7,utf8_decode('Cantidad solicitudes enviadas por profesor'),1,1,'C',FALSE);
		Fpdf::Ln(7);
		Fpdf::Cell(43,7,utf8_decode('Run'),1,0,'C',FALSE);
		Fpdf::Cell(113,7,utf8_decode('Nombre'),1,0,'C',FALSE);
		Fpdf::Cell(33,7,utf8_decode('Total Evidencias'),1,1,'C',FALSE);

		$total_ev = 0;
		foreach($datos as $dato)
		{
			$total_ev = $total_ev+1;
			$nombre_full = $dato->nombre1. ' ' .$dato->nombre2. ' ' .$dato->apellido1.' '.$dato->apellido2;
			Fpdf::Cell(43,7,utf8_decode($dato->run),1,0,'C',FALSE);
			Fpdf::Cell(113,7,utf8_decode($nombre_full),1,0,'C',FALSE);
			Fpdf::Cell(33,7,utf8_decode($dato->num_ev),1,1,'C',FALSE);
		}


		Fpdf::Ln(7);
		Fpdf::Cell(95,7,utf8_decode('Total asistentes'),1,0,'C',FALSE);
		Fpdf::Cell(95,7,utf8_decode('que onda'),1,1,'C',FALSE);
		Fpdf::Ln(7);
		Fpdf::Cell(190,7,utf8_decode('*Elaborado en base a un total de '.$total_ev.'  evidencias.'),0,1,'L',FALSE);
		Fpdf::Ln();      

		$fecha_actual = new Carbon;

		Fpdf::Output('I',"informe_2_".$fecha_actual);
		exit;
	}

}
