<?php

namespace App\Repositories;

use App\Models\Order_categories;
use App\Repositories\BaseRepository;

/**
 * Class Order_categoriesRepository
 * @package App\Repositories
 * @version May 17, 2022, 11:40 am IST
*/

class Order_categoriesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
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
        return Order_categories::class;
    }
}
