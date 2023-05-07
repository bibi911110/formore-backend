<?php

namespace App\Repositories;

use App\Models\Coupon_master_order;
use App\Repositories\BaseRepository;

/**
 * Class Coupon_master_orderRepository
 * @package App\Repositories
 * @version May 17, 2022, 12:03 pm IST
*/

class Coupon_master_orderRepository extends BaseRepository
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
        return Coupon_master_order::class;
    }
}
