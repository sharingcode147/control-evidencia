<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Carrera;

class ProfeNController extends Controller
{
    //
    public function get_carreras()
    {
        //
        //Evidencias en Curso
        // $carreras = Carreras::->select('profesor.*','formularios.fecha_realizacion','formularios.titulo','carreras.nombre_car','formularios.id','evidencias.created_at as fecha_creacion')
        //                         ->paginate(8);

        // $carreras = DB::table('carreras')->get();
        $carreras = Carrera::all();
                          
        return view('users.create',["carreras"=>$carreras]);
    }

}
