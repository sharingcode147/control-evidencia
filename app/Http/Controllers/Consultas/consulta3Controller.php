<?php

namespace App\Http\Controllers\Consultas;

use App\Evidencia;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class consulta3Controller extends Controller
{
    //
    public function index(){
    	$num_evidencia = Evidencia::select(DB::raw('count(*) as cant,codigo_car'))
                                            ->groupBy('codigo_car')
                                            ->get();
    	return view('consultas.consulta3',["evidencias"=>$num_evidencia]);
    }
}
