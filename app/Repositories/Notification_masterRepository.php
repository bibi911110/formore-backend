<?php

namespace App\Repositories;

use App\Models\Notification_master;
use App\Repositories\BaseRepository;

/**
 * Class Notification_masterRepository
 * @package App\Repositories
 * @version March 22, 2022, 10:38 am IST
*/

class Notification_masterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'details',
        'notification_image',
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
        return Notification_master::class;
    }
}
