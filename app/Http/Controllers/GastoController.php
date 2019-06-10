<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\GastoDetalle;
use App\GastoEncabezado;
use App\Alumno;
class GastoController extends Controller
{
    public function index(Request $request){
         if ( $request->input('showdata') ) {
            return GastoEncabezado::join('alumno','alumno.id','=','gastoencabezado.idAlumno')
           ->select('gastoencabezado.id','gastoencabezado.total','gastoencabezado.idAlumno',DB::raw('concat(alumno.nombre, " ", alumno.apellido) as alumno'),'gastoencabezado.cheque','gastoencabezado.created_at')
           ->orderBy('gastoencabezado.created_at', 'desc')->get();
       }      
    }
    public function detalle(Request $request){
        $id=$request->id;
        return GastoDetalle::select('id','gasto','subtotal')
        ->where('idGastoEncabezado','=',$id)
        ->orderBy('created_at', 'desc')->get();
    }
    public function drop(Request $request){
        $id=$request->id;
        $encabezado=GastoEncabezado::findOrFail($id);
        if($encabezado){
            try{
                
                DB::beginTransaction();
                    $alumno=Alumno::findOrFail($encabezado->idAlumno);
                    $alumno->presupuesto=$alumno->presupuesto+$encabezado->total;
                    $alumno->save();
                    $idEncabezado=$encabezado->id;
                    $detalle=GastoDetalle::where('idGastoEncabezado','=',$idEncabezado)->get();
                    foreach($detalle as $item){
                        $gasto=GastoDetalle::findOrFail($item->id);
                        $gasto->delete();
                    }
                    $encabezado->delete();
                DB::commit();
            }
            catch(Exception $e)
            {
                DB::rollBack();
            }
        }
        return 'Se ha eliminado el gasto';
    }
    public function store(Request $request){
       $total=$request->total;
       $idAlumno=$request->idAlumno;
       $cheque=$request->cheque;
       $data=$request->detalle;
       $detalle = json_decode(json_encode($data));
       try{           
            DB::beginTransaction();
                $alumno=Alumno::findOrFail($idAlumno);
                if($alumno->presupuesto >= $total){
                    $alumno->presupuesto=$alumno->presupuesto-$total;
                    $alumno->save();
                    $encabezado=new GastoEncabezado;
                    $encabezado->total=$total;
                    $encabezado->idAlumno=$idAlumno;
                    $encabezado->cheque=$cheque;
                    $encabezado->save();
                    $id=$encabezado->id;
                    foreach($detalle as $item){
                        $Gasto=new GastoDetalle;
                        $Gasto->idGastoEncabezado=$id;
                        $Gasto->gasto=$item->gasto;
                        $Gasto->subtotal=$item->subtotal;
                        $Gasto->save();
                    }
                }else{
                    DB::rollBack();
                    throw new Exception('No se puede realizar la operacion porque no se tiene el presupuesto');
                }
            DB::commit();
            return 'Hecho';
        }
        catch(Exception $e)
        {
            DB::rollBack();
            return 'Error';
        }
    }  
}
