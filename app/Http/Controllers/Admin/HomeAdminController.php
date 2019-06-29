<?php

namespace App\Http\Controllers\Admin;

use App\Evidencia;
use App\Formulario;
use App\Observaciones;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evidencias = Evidencia::where('estado','Pendiente')
                        ->join('profesor','evidencias.user_id','=','profesor.user_id')
                        ->join('formularios','evidencias.formulario_id','=','formularios.id')
                        ->join('carreras','evidencias.codigo_car','=','carreras.codigo_car')
                        ->select('profesor.*','formularios.fecha_realizacion','formularios.titulo','carreras.nombre_car','formularios.id','evidencias.created_at as fecha_creacion', 'evidencias.nivel')
                        ->paginate(8);
        return view('admin.home',["evidencias"=>$evidencias]);   
    }
}
