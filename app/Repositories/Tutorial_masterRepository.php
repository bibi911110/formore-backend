<?php

namespace App\Repositories;

use App\Models\Tutorial_master;
use App\Repositories\BaseRepository;

/**
 * Class Tutorial_masterRepository
 * @package App\Repositories
 * @version March 22, 2022, 10:35 am IST
*/

class Tutorial_masterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'details',
        'tutorial_video',
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
        return Tutorial_master::class;
    }
}
