<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table='alumno';
    protected $fillable = ['id','nombre','apellido','fechanacimiento','direccion','presupuesto','idNivel','idResponsable'];
    public function nivel(){
        return $this->belongTo('App\Nivel');
    }
    public function responsable(){
        return $this->belongTo('App\Responsable');
    }
}
