<?php

namespace App\Repositories;

use App\Models\Social_media_mgt;
use App\Repositories\BaseRepository;

/**
 * Class Social_media_mgtRepository
 * @package App\Repositories
 * @version January 27, 2023, 3:01 pm IST
*/

class Social_media_mgtRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'media_name',
        'media_category',
        'media_icon',
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
        return Social_media_mgt::class;
    }
}
