<?php

namespace App\Repositories;

use App\Models\User_voucher;
use App\Repositories\BaseRepository;

/**
 * Class User_voucherRepository
 * @package App\Repositories
 * @version March 30, 2022, 10:06 am IST
*/

class User_voucherRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'voucher_id',
        'user_id',
        'user_credit',
        'stamps',
        'points',
        'used_code_status'
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
        return User_voucher::class;
    }
}
