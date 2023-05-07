<?php

namespace App\Repositories;

use App\Models\Refer_business_details;
use App\Repositories\BaseRepository;

/**
 * Class Refer_business_detailsRepository
 * @package App\Repositories
 * @version March 22, 2022, 10:46 am IST
*/

class Refer_business_detailsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name_of_business',
        'owner_email',
        'your_name',
        'your_email',
        'term_check'
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
        return Refer_business_details::class;
    }
}
