<?php

namespace App\Repositories;

use App\Models\Week_off_master;
use App\Repositories\BaseRepository;

/**
 * Class Week_off_masterRepository
 * @package App\Repositories
 * @version May 18, 2022, 5:18 pm IST
*/

class Week_off_masterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'day',
        'status',
        'created_by'
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
        return Week_off_master::class;
    }
}
