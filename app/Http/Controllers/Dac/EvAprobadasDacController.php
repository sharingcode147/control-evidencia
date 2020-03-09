<?php

namespace App\Http\Controllers\dac;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Evidencia;
use App\Formulario;
use App\Observaciones;
class EvAprobadasDacController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evidencias = Evidencia::where([['estado','Finalizada'],['nivel',3],
                                ])
                                ->join('profesor','evidencias.user_id','=','profesor.user_id')
                                ->join('formularios','evidencias.formulario_id','=','formularios.id')
                                ->join('alcance','formularios.alcance_id','=','alcance.id')
                                ->join('ambito','formularios.ambito_id','=','ambito.id')
                                ->join('tipo','formularios.tipo_id','=','tipo.id')
                                ->join('carreras','evidencias.codigo_car','=','carreras.codigo_car')
                                ->select('profesor.*','formularios.fecha_realizacion','formularios.titulo','carreras.nombre_car','evidencias.id','evidencias.codigo_car','alcance.nombre as alcance','ambito.nombre as ambito','tipo.nombre as tipo')
                                ->get();
        return view('dac.evidenciasAprobadasDac',["evidencias"=>$evidencias]);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAprobadasDac($id)
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
                                ->select('formularios.*','ambito.nombre as ambito','alcance.nombre as alcance','tipo.nombre as tipo','profesor.*','carreras.nombre_car','evidencias.id as evidencia_id','evidencias.nivel','evidencias.estado')
                                ->get();

            $observaciones = Observaciones::where('evidencia_id',$id)
                                            ->join('users','users.id','=','observaciones.user_id')
                                            ->select('observaciones.*','users.name','users.email')
                                            ->orderBy('observaciones.created_at','desc')
                                            ->get();
            return view('Dac.evidenciaAprobadaNum',["datos"=>$datos,"observaciones"=>$observaciones]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
