<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GastoEncabezado extends Model
{
    protected $table='gastoencabezado';
    protected $fillable = ['id','total','idAlumno','cheque'];
}
