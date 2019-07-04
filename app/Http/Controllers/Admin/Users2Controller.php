<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use App\Profesor;
use App\Carrera;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Users2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $useradmin=DB::table('role_user')
                            ->where('role_id',1)
                            ->join('users','users.id','=','role_user.user_id')
                            ->orderBy('user_id','DESC')  
                            ->get();
        $userrevisor=DB::table('role_user')
                            ->where('role_id',3)
                            ->join('users','users.id','=','role_user.user_id')
                            ->orderBy('user_id','DESC')  
                            ->get();
        $userprofe=DB::table('role_user')
                            ->where('role_id',4)
                            ->join('users','users.id','=','role_user.user_id')
                            ->orderBy('user_id','DESC')  
                            ->get();
        $userdac=DB::table('role_user')
                            ->where('role_id',2)
                            ->join('users','users.id','=','role_user.user_id')
                            ->orderBy('user_id','DESC')  
                            ->get();
        return view('admin\Users.index',["useradmin"=>$useradmin,"userrevisor"=>$userrevisor,"userprofe"=>$userprofe,"userdac"=>$userdac]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
                         
      
        return view('admin\Users.create2');
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
            'email' => 'required|max:255',
            'pass' => 'required',
            ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =Hash::make($request->pass);
        $user->save();
        $user->roles()->attach(Role::where('name',$request->name )->first());
        return redirect()->route('users2.index')->with('success','Registro creado satisfactoriamente'); 
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
        return view('admin\Users.edit2',["user"=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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
            'email' => 'required|max:255',
            'pass' => 'required',
            ]);
 
        $user = User::find($id);
        $user->email = $request->email;
        $user->password = Hash::make($request->pass);
        $user->save();


        return redirect()->route('users2.index')->with('success','Registro actualizado satisfactoriamente');
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

