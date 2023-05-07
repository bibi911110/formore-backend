<?php

namespace App\Repositories;

use App\Models\Slot_master;
use App\Repositories\BaseRepository;

/**
 * Class Slot_masterRepository
 * @package App\Repositories
 * @version May 18, 2022, 5:16 pm IST
*/

class Slot_masterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'start_time',
        'end_time',
        'pepole_per_slot',
        'price_per_slot',
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
        return Slot_master::class;
    }
}
