<?php

namespace App\Repositories;

use App\Models\Social_icon;
use App\Repositories\BaseRepository;

/**
 * Class Social_iconRepository
 * @package App\Repositories
 * @version March 13, 2022, 11:46 am IST
*/

class Social_iconRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'social_icon',
        'link'
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
        return Social_icon::class;
    }
}
