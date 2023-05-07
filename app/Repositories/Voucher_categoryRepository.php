<?php

namespace App\Repositories;

use App\Models\Voucher_category;
use App\Repositories\BaseRepository;

/**
 * Class Voucher_categoryRepository
 * @package App\Repositories
 * @version March 24, 2022, 3:11 pm IST
*/

class Voucher_categoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'voucher_category',
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
        return Voucher_category::class;
    }
}
