<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Export_upload_scenario_1 implements FromCollection, WithHeadings
{

    private $data;

    public function __construct( $data )
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
            'User Name',
            'Voucher Code',
            ];
    }

    public function collection()
    {

        $array = [];
        foreach ($this->data as $value) {
            $array[] = [
                'user_id'        => $value['uname'],
                'voucher_code'         => $value['voucher_code'],
            ];
        }
        return collect($array);
    }

    
}
