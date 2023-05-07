<?php

namespace App\Repositories;

use App\Models\Order_product_extra_details;
use App\Repositories\BaseRepository;

/**
 * Class Order_product_extra_detailsRepository
 * @package App\Repositories
 * @version May 17, 2022, 11:49 am IST
*/

class Order_product_extra_detailsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'name',
        'available_quantities',
        'points_per_quantity',
        'price_per_quantity',
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
        return Order_product_extra_details::class;
    }
}
