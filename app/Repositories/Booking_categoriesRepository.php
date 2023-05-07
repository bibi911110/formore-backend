<?php

namespace App\Repositories;

use App\Models\Booking_categories;
use App\Repositories\BaseRepository;

/**
 * Class Booking_categoriesRepository
 * @package App\Repositories
 * @version May 17, 2022, 9:37 pm IST
*/

class Booking_categoriesRepository extends BaseRepository
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
        return Booking_categories::class;
    }
}
