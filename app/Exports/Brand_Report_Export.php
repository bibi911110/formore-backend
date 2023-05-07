<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Brand_Report_Export implements FromCollection, WithHeadings
{

    private $data;

    public function __construct( $data )
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
            'type',
            'name',
            'city',
            'category',
            'sub_category',
            'country',
            'Date',
            ];
    }

    public function collection()
    {

        $array = [];
        foreach ($this->data as $value) {

            if(isset($value['type']) && $value['type'] == '1')
            {
                $type = 'Business';
            }
            else if(isset($value['type']) && $value['type'] == '2')
            {
                $type = 'Brand';
            }
            else 
            {
                $type = 'Other';
            }
            $categoryData = \App\Models\Bussiness_cat_subcat_mapping::where('business_id',$value->id)->get();
            $cat = [];
            $sub_cat = [];

                          foreach ($categoryData as $catData) {
                              $catName = \App\Models\Category::where('id',$catData['cat_id'])
                                                              ->groupBy('category.id')
                                                              ->first();
                              $subName = \App\Models\Sub_category::where('id',$catData['sub_cat_id'])
                                                                ->groupBy('sub_category.id')
                                                                ->first();

                              //$cat[] =  $catName->name.",".$subName->name;  
                              $cat[] =  $catName->name;  
                              $sub_cat[] = $subName->name;  
                          }
                        


            $array[] = [
                'type'          => $type,
                'name'          => $value['name'],
                'city'          => $value['city_name'],
                'category'        => array_unique($cat),
                'sub_category'        => array_unique($sub_cat),
                'country'        => $value['country_name'],
                'date'        => date('d-m-Y',strtotime($value['created_at'])),
                
               ];
        }
        return collect($array);
    }

    
}
