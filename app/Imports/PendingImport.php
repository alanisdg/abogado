<?php

namespace App\Imports;

use App\Models\Pending;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PendingImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $p1 = substr($row['telefono'], 0, 2);
        $p2 = 9;
        $p3 = substr($row['telefono'], 3, 4);
        $p4 = substr($row['telefono'], 7, 9);
        $movil_phone = '+'.$p1.' '.$p2.' '.$p3.' '.$p4;


        $date1 = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_entrevista'])->format('d/m/Y');
        $date2 = ($row['fecha_segunda_cita'] == 'No Aplica') ? 'No Aplica' : \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_segunda_cita'])->format('d/m/Y');

        return new Pending([
            'interview_date' => $date1,
            'second_date' => $date2,
            'rut' => $row['rut'],
            //'email' => $row['correo_electronico'],
            'names' => $row['nombres'],
            'surnames' => $row['apellidos'],
            'balance_dd' => $row['saldo_dd'],
            'phone' => $movil_phone,
            'creditor_1' => $row['acreedor_1'],
            'creditor_balance_1' => $row['saldo_acreedor_1'],
            'creditor_2' => $row['acreedor_2'],
            'creditor_balance_2' => $row['saldo_acreedor_2'],
            'heritage' => $row['patrimonio'],
            'active_demand' => $row['demandas_activas'],
            'demand_1' => $row['demanda_1'],
            'state_1' => $row[ 'estado_1'],
            'demand_2' => $row['demanda_2'],
            'state_2' => $row['estado_2'],
            'status' => 1
        ]);
    }
}
