<?php

namespace App\Exports;

use App\Modals\Flag_selection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SectionExport implements FromCollection, WithHeadings
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
                'Segment',         
                'User',         
        ];
    }

    public function collection()
    {
        $array = [];
        foreach ($this->data as $value) {
               
        $array[] = [
                'business'               => $value['brandName'],
                'segment'              => $value['segment_name'],
                'users_name'              =>$value['users_name'], 

            ];

        }
        return collect($array);
    }

    
}
