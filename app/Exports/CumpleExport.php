<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class CumpleExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $queryResult = DB::select('CALL SP_LISTAR_CUMPLE()');
        return $result = collect($queryResult);
    }
}
