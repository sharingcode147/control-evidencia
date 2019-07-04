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

class DepController extends Controller
{
    //
     public function index()
    {
        //
        $dep=DB::table('departamentos')
                            ->orderBy('codigo_dep','DESC')  
                            ->get();
        return view('admin\Departamentos.index',["dep"=>$dep]); 
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $dep = Departamento::all();                  
      
        return view('admin\Departamentos.create',["dep"=>$dep]);
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
            ]);
        $user = new Departamento();
        $user->codigo_dep = $request->codigo;
        $user->nombre_dep = $request->name;
        $user->save();
        
        return redirect()->route('departamentos.index')->with('success','Registro creado satisfactoriamente'); 
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
                     
      
        $dep=Departamento::where('codigo_dep', $id)->first();
        
        return view('admin\Departamentos.edit',["dep"=>$dep]);
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
            ]);
 
        $carreras=Departamento::where('codigo_dep',$id)->first();
        $carreras->codigo_dep = $request->codigo_dep;
        $carreras->nombre_dep= $request->name;
        $carreras->save();

        return redirect()->route('departamentos.index')->with('success','Registro actualizado satisfactoriamente');
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
        Departamento::where('codigo_dep', $id)->delete();
       
        return redirect()->route('departamentos.index')->with('success','Registro eliminado satisfactoriamente');
    }

}
