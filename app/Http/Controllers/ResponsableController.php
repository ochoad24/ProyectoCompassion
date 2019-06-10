<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Responsable;
use Illuminate\Support\Facades\DB;
class ResponsableController extends Controller
{
    public function index(Request $request){
        if ( $request->input('showdata') ) {
    	    return Responsable::orderBy('created_at', 'desc')->get();
            
    	}
        $columns = ['nombre', 'apellido','direccion','telefono','created_at'];
        $length = $request->input('length');
        $column = $request->input('column'); 
        $search_input = $request->input('search');

        $query = Responsable::select('nombre', 'apellido','direccion','telefono' ,'created_at')->orderBy($columns[$column]);

        if ($search_input) {
            $query->where(function($query) use ($search_input) {
                $query->where('nombre', 'like', '%' . $search_input . '%')
                ->orWhere('apellido', 'like', '%' . $search_input . '%')
                ->orWhere('direccion', 'like', '%' . $search_input . '%')
                ->orWhere('telefono', 'like', '%' . $search_input . '%')
                ->orWhere('created_at', 'like', '%' . $search_input . '%');
            });
        }

        $users = $query->paginate($length);
        return ['data' => $users];
    }
    public function drop(Responsable $responsable){
        if($responsable) {
            $responsable->delete();
        }
        return 'Responsable Eliminado';
    }
    public function store(Request $request){
        // $id=$request->id;
        $nombre=$request->nombre;
        $apellido=$request->apellido;
        $direccion=$request->direccion;
        $telefono=$request->telefono;
        
        $responsable=new Responsable;
        $responsable->nombre=$nombre;
        $responsable->apellido=$apellido;
        $responsable->direccion=$direccion;
        $responsable->telefono=$telefono;
        $responsable->save();
        return 'Responsable Agregado';
    }
    public function edit(Request $request){
        $id=$request->id;
        $nombre=$request->nombre;
        $apellido=$request->apellido;
        $direccion=$request->direccion;
        $telefono=$request->telefono;
        
        $responsable=Responsable::findOrFail($id);;
        $responsable->nombre=$nombre;
        $responsable->apellido=$apellido;
        $responsable->direccion=$direccion;
        $responsable->telefono=$telefono;
        $responsable->save();
        return 'Responsable Editado';
    }
    public function select(Request $request){
        return Responsable::select(DB::raw('concat(responsable.nombre, " ", responsable.apellido) as name'),'id')->get();
    }
}
