<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class QuestionImport implements ToModel
{

    public function model( array $row )
    {
        return [
            'name'    => $row[0],
            'ans_type'      => $row[1],
            
        ];
    }
}
