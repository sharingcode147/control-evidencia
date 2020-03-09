<?php

namespace App\Http\Controllers\profesor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Evidencia;
use App\Formulario;
use App\Observaciones;
use App\Carrera;
use App\Alcance;
use App\Ambito;
use App\Tipo;
use App\Folio;

class EditEvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editnoAprob($id)
    {
        if (is_numeric($id)){
            $id_form = Evidencia::where('id',$id)->select('formulario_id')->first();
            if (empty($id_form))
                $formulario_id = 0;
            else
                $formulario_id = $id_form->formulario_id;
            $datos = Formulario::where('formularios.id',$formulario_id)
                                ->first();

            $carreras = Carrera::all();
            $alcances = Alcance::all();
            $ambitos = Ambito::all();
            $tipos = Tipo::all();
     
            return view('profesor.editaEvidencia',["id"=>$id,"datos"=>$datos,"carreras"=>$carreras,"alcances"=>$alcances,"ambitos"=>$ambitos,"tipos"=>$tipos]);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeeditanoAprob(Request $request, $id)
    {
        if($request->hasFile('archivoEvid'))
        {
            $file = $request->file('archivoEvid'); //recibo el archivo
            $name = time().$file->getClientOriginalName(); //le doy un nuevo nombre al archivo
            $file->move(public_path().'/filesev',$name);//moverlo a carpeta dentro del proyecto
        }
        $cod_carrera = Carrera::where('nombre_car',$request->name_car)->select('codigo_car')->first();
        $cod_alcance = Alcance::where('nombre',$request->name_alcance)->select('id')->first();
        $cod_tipo = Tipo::where('nombre',$request->name_tipo)->select('id')->first();
        $cod_ambito = Ambito::where('nombre',$request->name_ambito)->select('id')->first();


        $evidencia = Evidencia::find($id);
        $evidencia->codigo_car = $cod_carrera->codigo_car;
        $evidencia->nivel = 2;
        $evidencia->save();

        $formulari = Formulario::find($evidencia->formulario_id);
        $formulari->alcance_id = $cod_alcance->id;
        $formulari->ambito_id = $cod_ambito->id;
        $formulari->tipo_id = $cod_tipo->id;
        $formulari->titulo = $request->titulo;
        $formulari->descripcion = $request->descripcion;
        $formulari->fecha_realizacion = $request->fecha_realizacion;
        $formulari->int_estudiantes = $request->int_estudiantes;
        $formulari->int_profesores = $request->int_profesores;
        $formulari->int_autoridades = $request->int_autoridades;
        $formulari->int_profesionales = $request->int_profesionales;
        $formulari->ext_estudiantes = $request->ext_estudiantes ;
        $formulari->ext_profesores = $request->ext_profesores;
        $formulari->ext_autoridades = $request->ext_autoridades;
        $formulari->ext_profesionales = $request->ext_profesionales;
        $formulari->save();

        

         return redirect('profesor/home')->with('success', 'Book is successfully saved');
    }

    public function cancelarEv($id)
    {

        //  Buscando los datos actuales de la evidencia
        $evidencia = Evidencia::find($id);
        //  Cancelando la evidencia
        $evidencia->estado = "Cancelada";
        $evidencia->nivel = 1;
        $evidencia->save();
        //  Redirección al home de profesor
        return redirect('profesor/home')->with('evCancelada', 'Evidencia cancelada correctamente.');
    }

}
