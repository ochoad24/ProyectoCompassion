<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Alumno;

class AlumnoController extends Controller
{
    public function index(Request $request){
         
        if ( $request->input('showdata') ) {
             return Alumno::join('responsable','responsable.id','=','alumno.idResponsable')
            ->join('nivel','nivel.id','=','alumno.idNivel')
            ->select('alumno.id','alumno.nombre','alumno.apellido','alumno.fechanacimiento','alumno.direccion','alumno.presupuesto','alumno.idNivel','alumno.idResponsable',DB::raw('concat(responsable.nombre, " ", responsable.apellido) as responsable'),'nivel.nombre as nivel','alumno.created_at')
            ->orderBy('alumno.created_at', 'desc')->get();
        }
    }
    public function drop(Alumno $alumno){
        if($alumno) {
            $alumno->delete();
        }
        return 'Alumno Eliminado';
    }
    public function store(Request $request){
        // $id=$request->id;
        $nombre=$request->nombre;
        $apellido=$request->apellido; 
        $fechanacimiento=$request->fechanacimiento;
        $direccion=$request->direccion;
        $presupuesto=$request->presupuesto;
        $idNivel=$request->idNivel;
        $idResponsable=$request->idResponsable;
        
        $alumno=new Alumno;
        $alumno->nombre=$nombre;
        $alumno->apellido=$apellido;
        $alumno->fechanacimiento=$fechanacimiento;
        $alumno->direccion=$direccion;
        $alumno->presupuesto=$presupuesto;
        $alumno->idNivel=$idNivel;
        $alumno->idResponsable=$idResponsable;
        $alumno->save();
        return 'Alumno Agregado';
    }
    public function edit(Request $request){
       $id=$request->id;
       $nombre=$request->nombre;
       $apellido=$request->apellido; 
       $fechanacimiento=$request->fechanacimiento;
       $direccion=$request->direccion;
       $presupuesto=$request->presupuesto;
       $idNivel=$request->idNivel;
       $idResponsable=$request->idResponsable;
       
       $alumno=Alumno::findOrFail($id);
       $alumno->nombre=$nombre;
       $alumno->apellido=$apellido;
       $alumno->fechanacimiento=$fechanacimiento;
       $alumno->direccion=$direccion;
       $alumno->presupuesto=$presupuesto;
       $alumno->idNivel=$idNivel;
       $alumno->idResponsable=$idResponsable;
       $alumno->save();
       return 'Alumno Editado';
    }  
    public function select(Request $request){
        return Alumno::select(DB::raw('concat(alumno.nombre, " ", alumno.apellido) as name'),'id')->get();
    } 
}
