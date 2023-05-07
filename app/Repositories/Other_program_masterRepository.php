<?php

namespace App\Repositories;

use App\Models\Other_program_master;
use App\Repositories\BaseRepository;

/**
 * Class Other_program_masterRepository
 * @package App\Repositories
 * @version July 24, 2022, 12:54 pm IST
*/

class Other_program_masterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'type_code',
        'upload_photo',
        'surname'
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
        return Other_program_master::class;
    }
}
