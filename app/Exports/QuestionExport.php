<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;

class QuestionExport implements FromCollection, WithHeadings
{

    private $data;

    public function __construct( $data )
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
            'question',
            'select_ans',
            'range_ans',
            'rating_ans',
        ];
    }

    public function collection()
    {

        $array = [];
        foreach ($this->data as $value) {
            $array[] = [
                'question'          => $value['que'],
                'select_ans'        => $value['select_ans'],
                'range_ans'         => $value['range_ans'],
                'rating_ans'        => $value['rating_ans'],
            ];
        }
        return collect($array);
    }

    
}
