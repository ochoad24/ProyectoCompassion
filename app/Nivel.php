<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $table='nivel';
    protected $fillable = ['id','nombre','descripcion'];
    public function alumno()
    {
        return $this->hasMany('App\Alumno');
    }
}
