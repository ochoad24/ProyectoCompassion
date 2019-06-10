<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Datos;
class DatosController extends Controller
{   
    public function index(Request $request){
        $id=$request->id;
        return Datos::where('idAlumno','=',$id)->orderBy('created_at', 'desc')->get();
    }
    public function edit(Request $request){
        $id=$request->id;
        $peso=$request->peso;
        $altura=$request->altura;
        $datos=Datos::findOrFail($id);
        $datos->peso=$peso;
        $datos->altura=$altura;
        $datos->save();
        return 'Se ha modificado los datos correctamente';
    }
    public function drop(Request $request){
       $id=$request->id;
       $datos=Datos::findOrFail($id);
       $datos->delete();
       return 'Se ha eliminado los datos correctamente';
    }
    public function store(Request $request){
        $id=$request->idAlumno;
        $peso=$request->peso;
        $altura=$request->altura;
        $datos=new Datos;
        $datos->peso=$peso;
        $datos->altura=$altura;
        $datos->idAlumno=$id;
        $datos->save();
        return 'Se ha ingreado los datos correctamente';
    }  
}
