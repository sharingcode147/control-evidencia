<?php

namespace App\Http\Controllers\profesor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Carrera;
use App\Alcance;
use App\Ambito;
use App\Tipo;
use App\Formulario;
use App\Evidencia;
use App\Observaciones;
use App\Folio;


class NuevEvController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function nuevaEvidenciast(Request $request)
    {
        // $validatedData=$request->validate([
        //     'alcance_id' => 'required|numeric',
        //     'ambito_id' => 'required|numeric',
        //     'tipo_id' => 'required|numeric',
        //     'titulo' => 'required|max:255',
        //     'descripcion' => 'required|max:255',
        //     'fecha_realizacion' => 'required|date',
        //     'int_estudiantes' => 'required|numeric',
        //     'int_profesores' => 'required|numeric',
        //     'int_autoridades' => 'required|numeric',
        //     'int_profesionales' => 'required|numeric',
        //     'ext_estudiantes' => 'required|numeric',
        //     'ext_profesores' => 'required|numeric',
        //     'ext_autoridades' => 'required|numeric',
        //     'ext_profesionales' => 'required|numeric',
        //     'codigo_car' => 'required',
        //     ]);

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

        $formulari = new Formulario();

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

        $evidencia = new Evidencia;
        $evidencia->user_id = Auth::user()->id;
        $evidencia->formulario_id = $formulari->id;
        $evidencia->estado = 'Pendiente';
        $evidencia->nivel = 2;
        $evidencia->codigo_car = $cod_carrera->codigo_car;
        $evidencia->save();

         return redirect('profesor/home')->with('success', 'Book is successfully saved');
    }



    public function get_carreras()
    {
        //
        //Evidencias en Curso
        // $carreras = Carreras::->select('profesor.*','formularios.fecha_realizacion','formularios.titulo','carreras.nombre_car','formularios.id','evidencias.created_at as fecha_creacion')
        //                         ->paginate(8);

        // $carreras = DB::table('carreras')->get();
        $carreras = Carrera::all();
        $alcances = Alcance::all();
        $ambitos = Ambito::all();
        $tipos = Tipo::all();
                          
        return view('profesor.nuevaEvidencia',["carreras"=>$carreras,"alcances"=>$alcances,"ambitos"=>$ambitos,"tipos"=>$tipos]);
    }

}
