<?php

namespace App\Repositories;

use App\Models\About_us;
use App\Repositories\BaseRepository;

/**
 * Class About_usRepository
 * @package App\Repositories
 * @version March 13, 2022, 11:54 am IST
*/

class About_usRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
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
        return About_us::class;
    }
}
