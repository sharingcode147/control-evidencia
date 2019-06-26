<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    //
    protected $table = 'profesor';
    protected $primaryKey = 'run';
    protected $keyType = 'string';
    public $incrementing = false;
}
