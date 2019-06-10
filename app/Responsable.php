<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    protected $table='responsable';
    protected $fillable = ['id','nombre','apellido','direccion','telefono'];
    public function alumno()
    {
        return $this->hasMany('App\Alumno');
    }
}
