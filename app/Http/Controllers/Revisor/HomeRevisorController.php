<?php

namespace App\Http\Controllers\Revisor;

use App\Evidencia;
use App\Formulario;
use App\Observaciones;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeRevisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $evidencias = Evidencia::where('estado','Pendiente')
                                ->where('nivel','2')
                                ->join('profesor','evidencias.user_id','=','profesor.user_id')
                                ->join('formularios','evidencias.formulario_id','=','formularios.id')
                                ->join('carreras','evidencias.codigo_car','=','carreras.codigo_car')
                                ->select('profesor.*','formularios.fecha_realizacion','formularios.titulo','carreras.nombre_car','formularios.id','evidencias.created_at as fecha_creacion')
                                ->paginate(8);
        return view('revisor.home',["evidencias"=>$evidencias]);
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
            $id_form = Evidencia::where('id',$id)
                                ->where('nivel','2')
                                ->select('formulario_id')->first();
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
                                ->select('formularios.*','ambito.nombre as ambito','alcance.nombre as alcance','tipo.nombre as tipo','profesor.*','carreras.nombre_car','evidencias.id as evidencia_id')
                                ->get();

            $observaciones = Observaciones::where('evidencia_id',$id)
                                            ->join('users','users.id','=','observaciones.user_id')
                                            ->select('observaciones.*','users.name','users.email')
                                            ->orderBy('observaciones.created_at','desc')
                                            ->get();
            return view('revisor.formularioEvidencia',["datos"=>$datos,"observaciones"=>$observaciones]);
        }
        
    }

    /**
     * Modificar campo nivel de la tabla evidencias.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function aprobarEvidenciaRevisor($id)
    {
        //   Obteniendo los datos actuales de la evidencia.
        $evidencia = Evidencia::find($id);
        //   Cambiando los datos antiguos por los nuevos.
        $evidencia->nivel = 3;
        //   Guardando los cambios.
        $evidencia->save();
        return redirect()->route('revisorHome')->with('success','Evidencia enviada correctamente a D.A.C.');
    }

    /**
     * Agregar una observación a la evidencia y cambiar el nivel de la evidencia.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function observacionRevisor(Request $request, $id)
    {
        //  Validando los datos ingresados.
        $validatedData=$request->validate([
            'observacionRevisor' => 'required|string',
        ]);

        //  Creando la observación en la base de datos.
        $observacion = new Observaciones;
        $observacion->evidencia_id = $id;
        $observacion->observacion = $request->input('observacionRevisor');
        $observacion->user_id = auth()->user()->id;
        $observacion->nivel = 2;    //El nivel en que fue realizada la observación fue revisor.
        $observacion->save();

        //  Enviando la evidencia a profesor.
        $evidencia = Evidencia::find($id);  //Obteniendo los datos actuales de la evidencia. 
        $evidencia->nivel = 1;  //Cambiando el nivel a profesor.
        $evidencia->save();

        return redirect()->route('revisorHome')->with('success','Observación agregada correctamente. La evidencia volvió al profesor.');
    }
}
