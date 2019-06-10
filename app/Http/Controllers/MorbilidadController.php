<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Morbilidad;
class MorbilidadController extends Controller
{
    public function index(Request $request){
        if ( $request->input('showdata') ) {
    	    return Morbilidad::select('id','causas','created_at')->orderBy('created_at', 'desc')->get();
            
    	}
    }
    public function drop(Request $request){
        $id=$request->id;
        echo $id;
        $morbilidad=Morbilidad::where('id','=',$id)->firstOrFail();
        $morbilidad->delete();
        return 'Se ha eliminado el registro';
    }
    public function store(Request $request){
        $id=$request->id;
        $causas=$request->causas;
        $morbilidad=new Morbilidad;
        $morbilidad->id=$id;
        $morbilidad->causas=$causas;
        $morbilidad->save();
        return 'Se ha agregado el registro';
    }
    public function edit(Request $request){
        $id=$request->id;
        $causas=$request->causas;
        
        $morbilidad=Morbilidad::findOrFail($id);
        $morbilidad->id=$id;
        $morbilidad->causas=$causas;
        $morbilidad->save();
        return 'Se ha editado el registro';
    }
}
