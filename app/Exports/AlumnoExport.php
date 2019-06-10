<?php

namespace App\Exports;

use App\Alumno;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class AlumnoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Alumno::all();
        $queryResult = DB::select('CALL SP_LISTAR_ALUMNOS()');
        return $result = collect($queryResult);
    }
}
