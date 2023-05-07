<?php

namespace App\Repositories;

use App\Models\Coupon_master_services;
use App\Repositories\BaseRepository;

/**
 * Class Coupon_master_servicesRepository
 * @package App\Repositories
 * @version May 18, 2022, 9:18 am IST
*/

class Coupon_master_servicesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'coupon_code',
        'start_date',
        'end_date',
        'amount_type',
        'amount',
        'amount_discount',
        'points_discount',
        'coupon_info',
        'created_by',
        'status'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Coupon_master_services::class;
    }
}
