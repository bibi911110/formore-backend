<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Auth;
use Session;

class RatingExport implements FromCollection, WithHeadings
{

    protected  $id;

   /* public function __construct( $id )
    {
        $this->id = $id;
         
    }*/


    public function headings(): array
    {
        return [
            'User Name',
            'Unique number',
            'Business name',
            'Business rating',
            'Comment',
             ];
    }

    public function collection()
    {
        $buss_id = Session::get('buss_id'); 
       /*echo "<pre>";
        print_r($this->id); exit;*/
        if(isset($buss_id) && $buss_id != 'all')
        {
                if(Auth::user()->role_id == 3)
                {

                $data = \App\Models\Rating::orderBy('id','DESC')->where('rating.buss_id',Auth::user()->id)
                                            ->leftjoin('users','rating.user_id','users.id')
                                             ->where('rating.buss_id',$buss_id)
                                            ->select('rating.*','users.name as userName','users.unique_no')
                                            ->get()->toArray();
                }else{
               //echo $this->id; exit;
                $data = \App\Models\Rating::orderBy('id','DESC')->leftjoin('users','rating.user_id','users.id')
                                            ->where('rating.buss_id',$buss_id)
                                            ->select('rating.*','users.name as userName','users.unique_no')
                                            ->get()->toArray();
                /*echo "<pre>";
                print_r($data); exit;*/
                                            
                }

        }
        else
        {
              if(Auth::user()->role_id == 3)
                {

                $data = \App\Models\Rating::orderBy('id','DESC')->where('rating.buss_id',Auth::user()->id)
                                            ->leftjoin('users','rating.user_id','users.id')
                                            ->select('rating.*','users.name as userName','users.unique_no')
                                            ->get()->toArray();
                }else{

                $data = \App\Models\Rating::orderBy('id','DESC')->leftjoin('users','rating.user_id','users.id')
                                            ->select('rating.*','users.name as userName','users.unique_no')
                                            ->get()->toArray();
                                            
                }
        }

              
        $array = [];
        foreach ($data as $value) {
            $business_name = \App\User::where('role_id',3)->where('id',$value['buss_id'])->first();
            if(isset($business_name['name']))
            {
                $buss_name = $business_name['name'];
            }else{

                $buss_name ='-';
            }
            /*echo "<pre>";
            print_r($business_name['name']); exit();*/
            $array[] = [
                'user_id'        => $value['userName'],
                'Unique number'         => $value['unique_no'],
                'business name'         => $buss_name,
                'Business rating'         => $value['rating_no'],
                'Comment'                => $value['comment'],
            ];
        }
        /*echo "<pre>";
                print_r($array); exit;*/
       // return collect($array);
        return collect($array);
    }

    
}
