<?php

namespace App\Repositories;

use App\Models\Loyalty_banner_master;
use App\Repositories\BaseRepository;

/**
 * Class Loyalty_banner_masterRepository
 * @package App\Repositories
 * @version July 24, 2022, 12:57 pm IST
*/

class Loyalty_banner_masterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'terms_of_loyalty',
        'schema'
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
        return Loyalty_banner_master::class;
    }
}
