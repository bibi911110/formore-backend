<?php

namespace App\Repositories;

use App\Models\Booked_services;
use App\Repositories\BaseRepository;

/**
 * Class Booked_servicesRepository
 * @package App\Repositories
 * @version May 18, 2022, 8:59 am IST
*/

class Booked_servicesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'member_name',
        'member_id',
        'service_name',
        'booking_service_date_time',
        'comments',
        'advance_payment',
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
        return Booked_services::class;
    }
}
