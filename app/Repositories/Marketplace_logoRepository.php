<?php

namespace App\Repositories;

use App\Models\Marketplace_logo;
use App\Repositories\BaseRepository;

/**
 * Class Marketplace_logoRepository
 * @package App\Repositories
 * @version May 13, 2022, 3:50 pm IST
*/

class Marketplace_logoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'business_id',
        'position'
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
        return Marketplace_logo::class;
    }
}
