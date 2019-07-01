<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use App\Profesor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users=User::orderBy('id','DESC')->paginate(5);
        return view('admin\Users.index',["users"=>$users]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin\Users.create');
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
            'run' => 'required|max:255',
            'name1' => 'required|max:255',
            'name2' => 'required|max:255',
            'paterno' => 'required|max:255',
            'materno' => 'required|max:255',
            'email' => 'required|max:255',
            'pass' => 'required',
            'codigo_car' => 'required',
            ]);
        $user = new User();
        $user->name = 'profe';
        $user->email = $request->email;
        $user->password =Hash::make($request->pass);
        $user->save();
        $user->roles()->attach(Role::where('name', 'profesor')->first());
        $user-> datos_profesor($request->run,$request->name1,$request->name2,$request->paterno,$request->materno,$user->id);
        $user->profesor_carrera($request->run,$request->codigo_car); 
        return redirect()->route('users.index')->with('success','Registro creado satisfactoriamente'); 
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
        $user=User::find($id);
        $profe = Profesor::where('user_id', $id)->first();
        return view('admin\Users.edit',["user"=>$user,"profe"=>$profe]);
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
            'run' => 'required|max:255',
            'name1' => 'required|max:255',
            'name2' => 'required|max:255',
            'paterno' => 'required|max:255',
            'materno' => 'required|max:255',
            'email' => 'required|max:255',
            'pass' => 'required',
            'codigo_car' => 'required',
            ]);
 
        $user = User::find($id);
        $user->email = $request->email;
        $user->password = Hash::make($request->pass);
        $user->save();
        $profe = Profesor::find('user_id',$id);
        $profe->nombre1 = $request->name1;
        $profe->nombre2 = $request->name2;
        $profe->apellido1 = $request->paterno;
        $profe->apellido2 = $request->materno;
        $profe->save();


        return redirect()->route('users.index')->with('success','Registro actualizado satisfactoriamente');
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
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success','Registro eliminado satisfactoriamente');
    }
    
}

