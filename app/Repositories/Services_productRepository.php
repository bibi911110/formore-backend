<?php

namespace App\Repositories;

use App\Models\Services_product;
use App\Repositories\BaseRepository;

/**
 * Class Services_productRepository
 * @package App\Repositories
 * @version May 18, 2022, 8:50 am IST
*/

class Services_productRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'product_img',
        'price_per_slot',
        'point_per_slot',
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
        return Services_product::class;
    }
}
