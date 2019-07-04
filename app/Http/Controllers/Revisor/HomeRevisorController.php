<?php

namespace App\Http\Controllers\Revisor;

use App\Evidencia;
use App\Formulario;
use App\Observaciones;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class HomeRevisorController extends Controller
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
                                ->where('nivel','2')
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

    //Funcion para obtener las evidencias aprobadas
    public function getAp()
    {

        //Evidencias Aprobadas por Dac
        $evidencias = Evidencia::where([['estado','Finalizada'],['nivel',3],
                                ])
                                ->join('profesor','evidencias.user_id','=','profesor.user_id')
                                ->join('formularios','evidencias.formulario_id','=','formularios.id')
                                ->join('alcance','formularios.alcance_id','=','alcance.id')
                                ->join('ambito','formularios.ambito_id','=','ambito.id')
                                ->join('tipo','formularios.tipo_id','=','tipo.id')
                                ->join('carreras','evidencias.codigo_car','=','carreras.codigo_car')
                                ->select('profesor.*','formularios.fecha_realizacion','formularios.titulo','carreras.nombre_car','formularios.id','evidencias.codigo_car','alcance.nombre as alcance','ambito.nombre as ambito','tipo.nombre as tipo')
                                ->get();
        return view('revisor.evidenciaAprobadasDacRev',["evidencias"=>$evidencias]);
    }
    //Funcion para obtener las evidencias no aprobadas
    public function getNoAp()
    {
        //Evidencias Rechazadas
        $evidencias = Evidencia::where([['estado','Pendiente'],['nivel',1],
                                ])
                                ->join('profesor','evidencias.user_id','=','profesor.user_id')
                                ->join('formularios','evidencias.formulario_id','=','formularios.id')
                                ->join('alcance','formularios.alcance_id','=','alcance.id')
                                ->join('ambito','formularios.ambito_id','=','ambito.id')
                                ->join('tipo','formularios.tipo_id','=','tipo.id')
                                ->join('carreras','evidencias.codigo_car','=','carreras.codigo_car')
                                ->select('profesor.*','formularios.fecha_realizacion','formularios.titulo','carreras.nombre_car','formularios.id','evidencias.codigo_car','alcance.nombre as alcance','ambito.nombre as ambito','tipo.nombre as tipo')
                                ->get();

        return view('revisor.evidenciaNoAprobadas',["evidencias"=>$evidencias]);
    }

    //Funcion para mostrar las evidencias aprobadas y no aprobadas.
    public function showAprobadas($id)
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
            return view('revisor.evidenciaAprobada',["datos"=>$datos,"observaciones"=>$observaciones]);
        }
    }

    public function enviadasDAC()
    {
        $evidencias = Evidencia::where([['estado','Pendiente'],['nivel',3],
                                ])
                                ->join('profesor','evidencias.user_id','=','profesor.user_id')
                                ->join('formularios','evidencias.formulario_id','=','formularios.id')
                                ->join('alcance','formularios.alcance_id','=','alcance.id')
                                ->join('ambito','formularios.ambito_id','=','ambito.id')
                                ->join('tipo','formularios.tipo_id','=','tipo.id')
                                ->join('carreras','evidencias.codigo_car','=','carreras.codigo_car')
                                ->select('profesor.*','formularios.fecha_realizacion','formularios.titulo','carreras.nombre_car','formularios.id','evidencias.codigo_car','alcance.nombre as alcance','ambito.nombre as ambito','tipo.nombre as tipo')
                                ->get();
        return view('revisor.evidenciasEnviadasDac',["evidencias"=>$evidencias]);   
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
