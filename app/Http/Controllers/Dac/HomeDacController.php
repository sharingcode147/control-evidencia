<?php

namespace App\Http\Controllers\Dac;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeDacController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('dac.home');   
    }
}
