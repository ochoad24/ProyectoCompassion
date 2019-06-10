<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\AlumnoExport;
use App\Exports\CumpleExport;
use App\Exports\GastosExport;
use App\Exports\AlturaExport;
use App\Exports\HistorialExport;
use App\Exports\PesoExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function alumno(){
        return Excel::download(new AlumnoExport,'alumno.xlsx');
    }
    public function cumple(){
        return Excel::download(new CumpleExport,'cumple.xlsx');
    }
    public function gasto(Request $request){
        $id=(int)$request->id;
        return Excel::download(new GastosExport($id),'gasto.xlsx');
    }
    public function altura(){
        return Excel::download(new AlturaExport,'altura.xlsx');
    }
    public function historial(Request $request){
        $id=(int)$request->id;
        return Excel::download(new HistorialExport($id),'historial.xlsx');
    }
    public function peso(Request $request){
        $id=(int)$request->id;
        return Excel::download(new PesoExport($id),'historialpesoaltura.xlsx');
    }
}
