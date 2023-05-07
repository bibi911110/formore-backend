<?php

namespace App\Repositories;

use App\Models\App_screen_information;
use App\Repositories\BaseRepository;

/**
 * Class App_screen_informationRepository
 * @package App\Repositories
 * @version March 15, 2022, 11:40 am IST
*/

class App_screen_informationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'screen_name',
        'language_id',
        'content'
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
        return App_screen_information::class;
    }
}
