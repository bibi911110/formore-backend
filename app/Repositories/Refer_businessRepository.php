<?php

namespace App\Repositories;

use App\Models\Refer_business;
use App\Repositories\BaseRepository;

/**
 * Class Refer_businessRepository
 * @package App\Repositories
 * @version March 22, 2022, 10:42 am IST
*/

class Refer_businessRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'refer_icon',
        'refer_text',
        'term_details',
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
        return Refer_business::class;
    }
}
