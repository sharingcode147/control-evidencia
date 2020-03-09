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
                                ->select('profesor.*','formularios.fecha_realizacion','formularios.titulo','carreras.nombre_car','evidencias.id','evidencias.codigo_car','alcance.nombre as alcance','ambito.nombre as ambito','tipo.nombre as tipo')
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
                                ->select('profesor.*','formularios.fecha_realizacion','formularios.titulo','carreras.nombre_car','evidencias.id','evidencias.codigo_car','alcance.nombre as alcance','ambito.nombre as ambito','tipo.nombre as tipo')
                                ->paginate(8);

        return view('profesor.evidenciasCursoDac',["evidencias"=>$evidencias]);
    }
    public function showrev($id)
    {
        //
        if (is_numeric($id)){
            $id_form = Evidencia::where('id',$id)->select('formulario_id')->first();
            if (empty($id_form))
                $formulario_id = 0;
            else
                $formulario_id = $id_form->formulario_id;
            $datos = Formulario::where('formularios.id',$formulario_id)
                                ->join('ambito','ambito.id','=','formularios.ambito_id')
                                ->join('alcance','alcance.id','=','formularios.alcance_id')
                                ->join('tipo','tipo.id','=','formularios.tipo_id')
                                ->join('evidencias','evidencias.formulario_id','=','formularios.id')
                                ->join('profesor','evidencias.user_id','=','profesor.user_id')
                                ->join('carreras','evidencias.codigo_car','=','carreras.codigo_car')
                                ->join('departamentos','carreras.codigo_dep','=','departamentos.codigo_dep')
                                ->select('formularios.*','ambito.nombre as ambito','alcance.nombre as alcance','tipo.nombre as tipo','profesor.*','carreras.nombre_car')
                                ->select('formularios.*','ambito.nombre as ambito','alcance.nombre as alcance','tipo.nombre as tipo','profesor.*','carreras.nombre_car','evidencias.id as evidencia_id','departamentos.nombre_dep')
                                ->get();

            $observaciones = Observaciones::where('evidencia_id',$id)
                                            ->join('users','users.id','=','observaciones.user_id')
                                            ->select('observaciones.*','users.name','users.email')
                                            ->orderBy('observaciones.created_at','desc')
                                            ->get();
            return view('profesor.evidenciaCurso',["datos"=>$datos,"observaciones"=>$observaciones]);
        }
    }

}
