<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class PesoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;
    public function __construct($id)
    {
        $this->id = $id; 
    }
    public function collection()
    {
        $queryResult = DB::select('CALL HistorialAlturaPeso(?);',[$this->id]);
        return $result = collect($queryResult);
    }
}
