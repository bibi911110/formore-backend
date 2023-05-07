<?php

namespace App\Repositories;

use App\Models\Order_products;
use App\Repositories\BaseRepository;

/**
 * Class Order_productsRepository
 * @package App\Repositories
 * @version May 17, 2022, 11:44 am IST
*/

class Order_productsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cat_id',
        'name',
        'product_img',
        'ingredients_name',
        'available_quantities',
        'price_per_quantity',
        'points_per_quantity',
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
        return Order_products::class;
    }
}
