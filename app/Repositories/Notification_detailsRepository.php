<?php

namespace App\Repositories;

use App\Models\Notification_details;
use App\Repositories\BaseRepository;

/**
 * Class Notification_detailsRepository
 * @package App\Repositories
 * @version March 29, 2022, 10:50 am IST
*/

class Notification_detailsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'notification_id',
        'user_id',
        'created_at'
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
        return Notification_details::class;
    }
}
