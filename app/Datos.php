<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datos extends Model
{
    protected $table='datos';
    protected $fillable = ['id','idAlumno','peso','altura'];
}
