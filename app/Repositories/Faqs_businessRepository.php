<?php

namespace App\Repositories;

use App\Models\Faqs_business;
use App\Repositories\BaseRepository;

/**
 * Class Faqs_businessRepository
 * @package App\Repositories
 * @version April 21, 2022, 10:08 pm IST
*/

class Faqs_businessRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'question',
        'answer',
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
        return Faqs_business::class;
    }
}
