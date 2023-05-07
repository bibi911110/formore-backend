<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Upload_receipt_export implements FromCollection, WithHeadings
{

    private $data;

    public function __construct( $data )
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
            'Business Name',
            'User Name',
            'Voucher Code',
            'vat_number',
            'date_of_purchase',
            'time',
            'status',
            'comment',
        ];
    }

    public function collection()
    {

        $array = [];
        foreach ($this->data as $value) {
            $array[] = [
                'business_id'       => $value['bussName'],
                'user_id'        => $value['uname'],
                'voucher_id'         => $value['voucherCode'],
                'vat_number'        => $value['vat_number'],
                'date_of_purchase'        => $value['date_of_purchase'],
                'time'        => $value['time'],
                'status'        => $value['status'],
                'comment'        => $value['comment'],
            ];
        }
        return collect($array);
    }

    
}
