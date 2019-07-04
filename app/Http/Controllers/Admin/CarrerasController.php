<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use App\Departamento;
use App\Profesor;
use App\Carrera;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CarrerasController extends Controller
{
    //
    public function index()
    {
        //
        $carrera=DB::table('carreras')
                            ->orderBy('codigo_car','DESC')  
                            ->get();
        return view('admin\Carreras.index',["carrera"=>$carrera]); 
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $carreras = Departamento::all();                  
      
        return view('admin\Carreras.create',["carreras"=>$carreras]);
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
        $validatedData=$request->validate([
            'name' => 'required|max:255',
            'codigo' => 'required|max:255',
            'codigo_dep' => 'required',
            ]);
        $user = new Carrera();
        $user->codigo_car = $request->codigo;
        $user->nombre_car = $request->name;
        $user->codigo_dep= $request->codigo_dep;
        $user->save();
        
        return redirect()->route('carreras.index')->with('success','Registro creado satisfactoriamente'); 
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
        $dep = Departamento::all();               
      
        $carreras=Carrera::where('codigo_car', $id)->first();
        
        return view('admin\Carreras.edit',["carreras"=>$carreras,"dep"=>$dep]);
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
        $validatedData=$request->validate([
            'codigo_dep' => 'required',
            'name' => 'required|max:255',
            'codigo_car' => 'required',
            ]);
 
        $carreras=Carrera::where('codigo_car',$id)->first();
        $carreras->codigo_car = $request->codigo_car;
        $carreras->codigo_dep = $request->codigo_car;
        $carreras->nombre_carrera= $request->name;
        $carreras->save();


        return redirect()->route('carreras.index')->with('success','Registro actualizado satisfactoriamente');
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
        Carrera::where('codigo_car', $id)->delete();
       
        return redirect()->route('carreras.index')->with('success','Registro eliminado satisfactoriamente');
    }
}
