<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    protected $table='diagnostico';
    protected $fillable = ['id','idAlumno','especialidad','descripcion'];
}
