<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Prueba extends Controller
{
    
	public function upload(Request $request){

		if(count($request->images))
		{
			foreach($request->images as $image)
			{
				$image->store('images');
			}
		}


		return response()->json([
				"message" => "Done"
		]);
	}
}
