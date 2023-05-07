<?php

namespace App\Repositories;

use App\Models\Promotional_image_master;
use App\Repositories\BaseRepository;

/**
 * Class Promotional_image_masterRepository
 * @package App\Repositories
 * @version July 24, 2022, 12:52 pm IST
*/

class Promotional_image_masterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'image_1',
        'counter_1',
        'image_2',
        'counter_2',
        'image_3',
        'counter_3',
        'image_4',
        'counter_4',
        'image_5',
        'counter_5',
        'from_date',
        'to_date'
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
        return Promotional_image_master::class;
    }
}
