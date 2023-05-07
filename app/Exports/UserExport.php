<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
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
                'email',         
                'mobile_no',         
                'uniqueID',         
                'birth_date',         
                'sex',         
                'marital_status',         
                'no_kids',         
                'entartainment',         
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
        /*echo "<pre>";
        print_r($this->data['sex']);exit;*/
        $array = [];
        $sex ;
       /* foreach ($this->data as $value) {*/
        if(!empty($this->data['sex']) && $this->data['sex'] == '1')
        {
            $sex = 'Male';
        }else if(!empty($this->data['sex']) && $this->data['sex'] == '2')
        {
            $sex = 'Female';
        }else{
            $sex = '-';
        }
        if($this->data['marital_status'] == '1')
        {
            $marital_status = 'Married';
        }
        else 
        {
            $marital_status = 'Unmarried';
        }
        if($this->data['entartainment'] == '1')
        {
            $entartainment = 'Yes';
        }
        else 
        {
            $entartainment = 'No';
        }
        if($this->data['sports'] == '1')
        {
            $sports = 'Yes';
        }
        else 
        {
            $sports = 'No';
        }
        if($this->data['electronic_games'] == '1')
        {
            $electronic_games = 'Yes';
        }
        else 
        {
            $electronic_games = 'No';
        }
        if($this->data['technolocgy'] == '1')
        {
            $technolocgy = 'Yes';
        }
        else 
        {
            $technolocgy = 'No';
        }
        if($this->data['food'] == '1')
        {
            $food = 'Yes';
        }
        else 
        {
            $food = 'No';
        }
        if($this->data['music'] == '1')
        {
            $music = 'Yes';
        }
        else 
        {
            $music = 'No';
        }
        if($this->data['nightlife'] == '1')
        {
            $nightlife = 'Yes';
        }
        else 
        {
            $nightlife = 'No';
        }
        if($this->data['no_kids'] != '')
        {
            $no_kids = $this->data['no_kids'];
        }
        else 
        {
            $no_kids = '-';
        }
        $array[] = [
                'name'               => $this->data['name'],
                'email'              => $this->data['email'],
                'mobile_no'              =>$this->data['mobile_code'].'-'.$this->data['mobile_no'],
                'uniqueID'              => $this->data['unique_no'],
                'birth_date'              => date('d-m-Y',strtotime($this->data['birth_date'])),
                'sex'              => $sex,
                'marital_status'              => $marital_status,
                'no_kids'              => $no_kids,
                'entartainment'              => $entartainment,
                'sports'              => $sports,
                'electronic_games'              => $electronic_games,
                'technolocgy'              => $technolocgy,
                'food'              => $food,
                'music'              => $music,
                'nightlife'              => $nightlife,
                

                

            ];
        /*}*/
        return collect($array);
    }

    
}
