<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Donacion;
class DonacionController extends Controller
{
    public function index(){
        return Donacion::orderBy('created_at', 'desc')->get();
    }
}
