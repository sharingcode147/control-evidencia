<?php

namespace App\Http\Controllers\Dac;

use App\Evidencia;
use App\Formulario;
use App\Observaciones;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class HomeDacController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obteniendo los datos sobre evidencias.
        $evidencias = Evidencia::where('estado','Pendiente')
                                ->where('nivel','3')
                                ->join('profesor','evidencias.user_id','=','profesor.user_id')
                                ->join('formularios','evidencias.formulario_id','=','formularios.id')
                                ->join('carreras','evidencias.codigo_car','=','carreras.codigo_car')
                                ->select('profesor.*','formularios.fecha_realizacion','formularios.titulo','carreras.nombre_car','formularios.id','evidencias.created_at as fecha_creacion','evidencias.id as evidencia_id')
                                ->paginate(8);

        //  Obteniendo la cantidad de observaciones que tienen las evidencias.
        $num_observaciones = Observaciones::select(DB::raw('count(*) as revisiones, evidencia_id'))
                                            ->groupBy('evidencia_id')
                                            ->get();


        //  Recorriendo las evidencias
        foreach ($evidencias as $evidencia) {
            $evidencia->revisiones = 0; //Asumo que la evidencia no tiene observaciones.
            foreach ($num_observaciones as $obs) {
                //  Revisando si la evidencia tiene observaciones y asignandolas en caso de ser asi.
                if($obs->evidencia_id == $evidencia->id){
                    $evidencia->revisiones = $obs->revisiones;
                }
            }
            $fecha_actual = new Carbon;
            $fecha = Carbon::parse($evidencia->fecha_creacion);
            $evidencia->dias = $fecha_actual->diffInDays($fecha);;
        }
        return view('dac.home',["evidencias"=>$evidencias]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
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
                                ->select('formularios.*','ambito.nombre as ambito','alcance.nombre as alcance','tipo.nombre as tipo','profesor.*','carreras.nombre_car')
                                ->select('formularios.*','ambito.nombre as ambito','alcance.nombre as alcance','tipo.nombre as tipo','profesor.*','carreras.nombre_car','evidencias.id as evidencia_id')
                                ->get();

            $observaciones = Observaciones::where('evidencia_id',$id)
                                            ->join('users','users.id','=','observaciones.user_id')
                                            ->select('observaciones.*','users.name','users.email')
                                            ->orderBy('observaciones.created_at','desc')
                                            ->get();
            return view('dac.formularioDac',["datos"=>$datos,"observaciones"=>$observaciones]);
        }
    }
}


