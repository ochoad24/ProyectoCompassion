<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donacion extends Model
{
    protected $table='invoices';
    protected $fillable = ['title', 'price', 'payment_status'];
}
