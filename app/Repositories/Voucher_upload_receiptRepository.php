<?php

namespace App\Repositories;

use App\Models\Voucher_upload_receipt;
use App\Repositories\BaseRepository;

/**
 * Class Voucher_upload_receiptRepository
 * @package App\Repositories
 * @version March 29, 2022, 5:56 pm IST
*/

class Voucher_upload_receiptRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'business_id',
        'user_id',
        'voucher_id',
        'vat_number',
        'date_of_purchase',
        'time',
        'upload_receipt'
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
        return Voucher_upload_receipt::class;
    }
}
