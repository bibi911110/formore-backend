<?php

namespace App\Repositories;

use App\Models\Holiday_master;
use App\Repositories\BaseRepository;

/**
 * Class Holiday_masterRepository
 * @package App\Repositories
 * @version May 18, 2022, 5:19 pm IST
*/

class Holiday_masterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'date',
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
        return Holiday_master::class;
    }
}
