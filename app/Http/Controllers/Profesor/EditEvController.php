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
     
            return view('profesor.editaEvidencia',["datos"=>$datos,"carreras"=>$carreras,"alcances"=>$alcances,"ambitos"=>$ambitos,"tipos"=>$tipos]);
        }

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
    public function storeeditanoAprob(Request $request)
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
