<?php

namespace App\Repositories;

use App\Models\Gift_vocher_types;
use App\Repositories\BaseRepository;

/**
 * Class Gift_vocher_typesRepository
 * @package App\Repositories
 * @version May 4, 2022, 9:28 am IST
*/

class Gift_vocher_typesRepository extends BaseRepository
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
        return Gift_vocher_types::class;
    }
}
