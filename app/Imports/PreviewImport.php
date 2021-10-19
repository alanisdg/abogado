<?php

namespace App\Imports;

use App\Models\Contact;
use App\Models\Pending;
use App\Models\Preview;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PreviewImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);
        return new Contact([
            'rut' => !empty($row['rut']) ?   $row['rut'] :  '' ,
            'phone' => !empty($row['telefono']) ?  strval( $row['telefono']) :  '' ,
            'email' => !empty($row['email']) ?   $row['email'] :  '' ,
            'comuna' => !empty($row['comuna']) ?   $row['comuna'] :  '' ,
            'name' => !empty($row['nombre']) ?   $row['nombre'] :  '' ,
            'state_id' => 1,
        ]);

    }
}
