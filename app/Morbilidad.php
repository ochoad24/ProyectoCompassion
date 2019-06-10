<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Morbilidad extends Model
{
    protected $table='morbilidad';
    protected $fillable = ['id','causas'];
    public $incrementing = false;
}
