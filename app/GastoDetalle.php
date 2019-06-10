<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GastoDetalle extends Model
{
    protected $table='gastodetalle';
    protected $fillable = ['id','idGastoEncabezado','gasto','subtotal'];
}
