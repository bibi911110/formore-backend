<?php

namespace App\Repositories;

use App\Models\Link_master;
use App\Repositories\BaseRepository;

/**
 * Class Link_masterRepository
 * @package App\Repositories
 * @version March 22, 2022, 10:39 am IST
*/

class Link_masterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'term_link',
        'privacy_link'
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
        return Link_master::class;
    }
}
