<?php

namespace App\Http\Controllers\Consultas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Consulta1 extends Controller
{
    //
    public function index(){
    	return view('consultas.consulta1');
    }
}
