<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Transaction_Report_Export implements FromCollection, WithHeadings
{

    private $data;

    public function __construct( $data )
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
            'Business',
            'User',
            'Transaction Type',
            'Stamps',
           /* 'info',*/
            'Points',
            'Date',
            
            ];
    }

    public function collection()
    {

        $array = [];
        foreach ($this->data as $value) {

            $array[] = [
                'brandName'          => $value['brandName'],
                'username'        => $value['username'],
                'transaction'        => $value['transaction'],
                'point_per_stamp'        =>$value['point_per_stamp'],
                'current_point'        =>$value['current_point'],
                'Date'        =>date('d-m-Y',strtotime($value['created_at'])),
               
               ];
        }
        return collect($array);
    }

    
}
