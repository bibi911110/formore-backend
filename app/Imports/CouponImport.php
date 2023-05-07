<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class CouponImport implements ToModel
{

    public function model( array $row )
    {
        return [
            'code'    				=> $row[0],
            'start_date'     		=> $row[1],
            'end_date'      		=> $row[2],
            'terms_eng'      		=> $row[3],
            'terms_italian'     	=> $row[4],
            'terms_greek'      		=> $row[5],
            'terms_albanian'    	=> $row[6],
            'description_eng'   	=> $row[7],
            'description_italian'   => $row[8],
            'description_greek'     => $row[9],
            'description_albanian'  => $row[10],
            
        ];
    }
}
