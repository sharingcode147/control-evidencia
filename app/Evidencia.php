<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    //
    protected $table = 'evidencias';
    protected $fillable = ['user_id','formulario_id','estado','nivel','codigo_car'];
}
