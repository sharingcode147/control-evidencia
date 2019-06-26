<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    //
    protected $table = 'formularios';
    protected $fillable = ['alcance_id', 'ambito_id', 'tipo_id','titulo','descripcion','fecha_realizacion','int_estudiantes','int_profesores','int_autoridades','int_profesionales','ext_estudiantes','ext_profesores','ext_autoridades','ext_profesionales'];
}
