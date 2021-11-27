<?php

namespace App\Imports;

use App\Models\Rate;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;


class RatesImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use Importable, SkipsErrors ;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $contract;
    
    public function __construct(String $contract)
    {
        $this->contract = $contract;
    }

    public function model(array $row)
    {
        return new Rate([
            'origin'        => $row['pol'],
            'destination'   => $row['pod'], 
            'currency'      => $row['curr'],
            'twenty'        => $row['20gp'],
            'forty'         => $row['40gp'],
            'fortyhc'       => $row['40hc'],
            'contract_id'   => $this->contract
        ]);
    }
}
