<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nivel;
class NivelController extends Controller
{
    public function index(Request $request){
        if ( $request->input('showdata') ) {
    	    return Nivel::orderBy('created_at', 'desc')->get();
            
    	}
        $columns = ['nombre', 'descripcion', 'created_at'];
        $length = $request->input('length');
        $column = $request->input('column'); 
        $search_input = $request->input('search');

        $query = Nivel::select('nombre', 'descripcion', 'created_at')->orderBy($columns[$column]);

        if ($search_input) {
            $query->where(function($query) use ($search_input) {
                $query->where('nombre', 'like', '%' . $search_input . '%')
                ->orWhere('descripcion', 'like', '%' . $search_input . '%')
                ->orWhere('created_at', 'like', '%' . $search_input . '%');
            });
        }

        $users = $query->paginate($length);
        return ['data' => $users];
    }
    public function drop(Nivel $nivel){
        if($nivel) {
            $nivel->delete();
        }
        return 'Nivel Eliminado';
    }
    public function store(Request $request){
        // $id=$request->id;
        $nombre=$request->nombre;
        $descripcion=$request->descripcion;
        $nivel=new Nivel;
        $nivel->nombre=$nombre;
        $nivel->descripcion=$descripcion;
        $nivel->save();
        return 'Nivel Agregado';
    }
    public function edit(Request $request){
        $id=$request->id;
        $nombre=$request->nombre;
        $descripcion=$request->descripcion;
        $nivel=Nivel::findOrFail($id);
        $nivel->nombre=$nombre;
        $nivel->descripcion=$descripcion;
        $nivel->save();
        return 'Nivel Editado';
    }
    public function select(Request $request){
        return Nivel::select('nombre as name','id')->get();
    }
}
