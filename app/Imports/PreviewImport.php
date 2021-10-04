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
        return new Contact([
            'rut' => $row['rut'],
            'phone' => $row['telefono'],
            'date' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha'])),
            'hour' => $row['hora'],
            'email' => $row['email'],
            'comuna' => $row['comuna'],
            'name' => $row['nombre'],
            'state_id' => 1,
        ]);

    }
}
