<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VoucherExport implements FromCollection, WithHeadings
{

    private $data;

    public function __construct( $data )
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
            'code',
            'message'
        ];
    }

    public function collection()
    {

        $array = [];
        foreach ($this->data as $value) {
            $array[] = [
                'code'          => $value['code'],
                'message'          => $value['message'],
                

            ];
        }
        return collect($array);
    }

    
}
