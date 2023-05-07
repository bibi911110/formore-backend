<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;

class User_Report_Export implements FromCollection, WithHeadings
{

    private $data;

    public function __construct( $data )
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
            'name',
            'language',
            'mobile_no',
            'unique_no',
           /* 'info',*/
            'email',
            'birth_date',
            'sex',
            'city',
            'country',
            'marital_status',
            'no_kids',
            'entartainment',
            'travelings',
            'sports',
            'electronic_games',
            'technolocgy',
            'food',
            'music',
            'nightlife',
            ];
    }

    public function collection()
    {

        $array = [];
        foreach ($this->data as $value) {

            if(isset($value['sex']) && $value['sex'] == '1')
            {
                $sex = 'Male';
            }
            else if(isset($value['sex']) && $value['sex'] == '2')
            {
                $sex = 'Female';
            }
            else if(isset($value['sex']) && $value['sex'] == '3')
            {
                $sex = 'Other';
            }else{
                $sex = '';
            }

            if(isset($value['marital_status']) && $value['marital_status'] == '1')
            {
                $marital_status = 'Married';
            }
            else if(isset($value['marital_status']) && $value['marital_status'] == '2')
            {
                $marital_status = 'Not Married';
            }
            else
            {
                $marital_status = '';
            }

            if(isset($value['entartainment']) && $value['entartainment'] == '1')
            {
                $entartainment = 'Yes';
            }
            else if(isset($value['entartainment']) && $value['entartainment'] == '0')
            {
                $entartainment = 'No';
            }
            else
            {
                $entartainment = '';
            }


            if(isset($value['entartainment']) && $value['entartainment'] == '1')
            {
                $entartainment = 'Yes';
            }
            else if(isset($value['entartainment']) && $value['entartainment'] == '0')
            {
                $entartainment = 'No';
            }
            else
            {
                $entartainment = '';
            }


            if(isset($value['travelings']) && $value['travelings'] == '1')
            {
                $travelings = 'Yes';
            }
            else if(isset($value['travelings']) && $value['travelings'] == '0')
            {
                $travelings = 'No';
            }
            else
            {
                $travelings = '';
            }

            if(isset($value['sports']) && $value['sports'] == '1')
            {
                $sports = 'Yes';
            }
            else if(isset($value['sports']) && $value['sports'] == '0')
            {
                $sports = 'No';
            }
            else
            {
                $sports = '';
            }


            if(isset($value['electronic_games']) && $value['electronic_games'] == '1')
            {
                $electronic_games = 'Yes';
            }
            else if(isset($value['electronic_games']) && $value['electronic_games'] == '0')
            {
                $electronic_games = 'No';
            }
            else
            {
                $electronic_games = '';
            }

            if(isset($value['technolocgy']) && $value['technolocgy'] == '1')
            {
                $technolocgy = 'Yes';
            }
            else if(isset($value['technolocgy']) && $value['technolocgy'] == '0')
            {
                $technolocgy = 'No';
            }
            else
            {
                $technolocgy = '';
            }

            if(isset($value['food']) && $value['food'] == '1')
            {
                $food = 'Yes';
            }
            else if(isset($value['food']) && $value['food'] == '0')
            {
                $food = 'No';
            }
            else
            {
                $food = '';
            }

            if(isset($value['music']) && $value['music'] == '1')
            {
                $music = 'Yes';
            }
            else if(isset($value['music']) && $value['music'] == '0')
            {
                $music = 'No';
            }
            else
            {
                $music = '';
            }

            if(isset($value['nightlife']) && $value['nightlife'] == '1')
            {
                $nightlife = 'Yes';
            }
            else if(isset($value['nightlife']) && $value['nightlife'] == '0')
            {
                $nightlife = 'No';
            }
            else
            {
                $nightlife = '';
            }





            $array[] = [
                'name'          => $value['name'],
                'language'        => $value['language_name'],
                'mobile_no'        => $value['mobile_code'].'-'.$value['mobile_no'],
                'unique_no'        =>$value['unique_no'],
               // 'info'        =>$value['info'],
                'email'        =>$value['email'],
                'birth_date'        =>$value['birth_date'],
                'sex'        =>$sex,
                'city'        =>$value['city'],
                'country_name'        =>$value['country_code'].'-'.$value['country_name'],
                'marital_status'        =>$marital_status,
                'no_kids'        =>$value['no_kids'],
                'entartainment'        =>$entartainment,
                'travelings'        =>$travelings,
                'sports'        =>$sports,
                'electronic_games'        =>$electronic_games,
                'technolocgy'        =>$technolocgy,
                'food'        =>$food,
                'music'        =>$music,
                'nightlife'        =>$nightlife,
               ];
        }
        return collect($array);
    }

    
}
