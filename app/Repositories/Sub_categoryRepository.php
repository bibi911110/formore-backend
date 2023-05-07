<?php

namespace App\Repositories;

use App\Models\Sub_category;
use App\Repositories\BaseRepository;

/**
 * Class Sub_categoryRepository
 * @package App\Repositories
 * @version March 10, 2022, 3:52 pm IST
*/

class Sub_categoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cat_id',
        'name',
        'icon',
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
        return Sub_category::class;
    }
}
