<?php

namespace App\Repositories;

use App\Models\Gallery_master;
use App\Repositories\BaseRepository;

/**
 * Class Gallery_masterRepository
 * @package App\Repositories
 * @version March 13, 2022, 11:45 am IST
*/

class Gallery_masterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'gallery_img'
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
        return Gallery_master::class;
    }
}
