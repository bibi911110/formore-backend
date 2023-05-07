<?php

namespace App\Repositories;

use App\Models\Extra_services;
use App\Repositories\BaseRepository;

/**
 * Class Extra_servicesRepository
 * @package App\Repositories
 * @version May 18, 2022, 8:53 am IST
*/

class Extra_servicesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'services_name',
        'services_per_price',
        'services_per_point',
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
        return Extra_services::class;
    }
}
