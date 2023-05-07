<?php

namespace App\Repositories;

use App\Models\Nfc_master;
use App\Repositories\BaseRepository;

/**
 * Class Nfc_masterRepository
 * @package App\Repositories
 * @version July 24, 2022, 12:58 pm IST
*/

class Nfc_masterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nfc_code',
        'nfc_url',
        'linked_url'
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
        return Nfc_master::class;
    }
}
