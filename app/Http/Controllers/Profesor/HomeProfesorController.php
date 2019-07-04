<?php

namespace App\Http\Controllers\Profesor;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Formulario;
use App\Evidencia;
use App\Observaciones;

class HomeProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('profesor.home');   
    }

    public function EvidenciaRevisor()
    {
        //

       $userID =  auth()->user()->id;  

        $evidencias = Evidencia::where([['estado','Pendiente'],['nivel',2],['evidencias.user_id',$userID],
                                ])
                                ->join('profesor','evidencias.user_id','=','profesor.user_id')
                                ->join('formularios','evidencias.formulario_id','=','formularios.id')
                                ->join('alcance','formularios.alcance_id','=','alcance.id')
                                ->join('ambito','formularios.ambito_id','=','ambito.id')
                                ->join('tipo','formularios.tipo_id','=','tipo.id')
                                ->join('carreras','evidencias.codigo_car','=','carreras.codigo_car')
                                ->select('profesor.*','formularios.fecha_realizacion','formularios.titulo','carreras.nombre_car','formularios.id','evidencias.codigo_car','alcance.nombre as alcance','ambito.nombre as ambito','tipo.nombre as tipo')
                                ->paginate(8);

        return view('profesor.evidenciasCursoRevisor',["evidencias"=>$evidencias]);
    }
    public function EvidenciaDac()
    {
        //
        $userID =  auth()->user()->id;  
        $evidencias = Evidencia::where([['estado','Pendiente'],['nivel',3],['evidencias.user_id',$userID],
                                ])
                                ->join('profesor','evidencias.user_id','=','profesor.user_id')
                                ->join('formularios','evidencias.formulario_id','=','formularios.id')
                                ->join('alcance','formularios.alcance_id','=','alcance.id')
                                ->join('ambito','formularios.ambito_id','=','ambito.id')
                                ->join('tipo','formularios.tipo_id','=','tipo.id')
                                ->join('carreras','evidencias.codigo_car','=','carreras.codigo_car')
                                ->select('profesor.*','formularios.fecha_realizacion','formularios.titulo','carreras.nombre_car','formularios.id','evidencias.codigo_car','alcance.nombre as alcance','ambito.nombre as ambito','tipo.nombre as tipo')
                                ->paginate(8);

        return view('profesor.evidenciasCursoDac',["evidencias"=>$evidencias]);
    }
}
