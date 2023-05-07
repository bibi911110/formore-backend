<?php

namespace App\Repositories;

use App\Models\Purchase_options;
use App\Repositories\BaseRepository;

/**
 * Class Purchase_optionsRepository
 * @package App\Repositories
 * @version March 13, 2022, 11:52 am IST
*/

class Purchase_optionsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'available',
        'points',
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
        return Purchase_options::class;
    }
}
