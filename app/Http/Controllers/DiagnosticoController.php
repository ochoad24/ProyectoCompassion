<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Diagnostico;
class DiagnosticoController extends Controller
{
    public function index(Request $request){
        $id=$request->id;
        return Diagnostico::where('idAlumno','=',$id)->orderBy('created_at', 'desc')->get();
    }
    public function edit(Request $request){
        $id=$request->id;
        $especialidad=$request->especialidad;
        $descripcion=$request->descripcion;
        $diagnostico=Diagnostico::findOrFail($id);
        $diagnostico->especialidad=$especialidad;
        $diagnostico->descripcion=$descripcion;
        $diagnostico->save();
        return 'Se ha modificado los datos correctamente';
    }
    public function drop(Request $request){
       $id=$request->id;
       $diagnostico=Diagnostico::findOrFail($id);
       $diagnostico->delete();
       return 'Se ha eliminado los datos correctamente';
    }
    public function store(Request $request){
        $id=$request->idAlumno;
        $especialidad=$request->especialidad;
        $descripcion=$request->descripcion;
        $diagnostico=new Diagnostico;
        $diagnostico->especialidad=$especialidad;
        $diagnostico->descripcion=$descripcion;
        $diagnostico->idAlumno=$id;
        $diagnostico->save();
        return 'Se ha ingreado los datos correctamente';
    } 
}
