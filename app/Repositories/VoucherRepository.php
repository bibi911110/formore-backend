<?php

namespace App\Repositories;

use App\Models\Voucher;
use App\Repositories\BaseRepository;

/**
 * Class VoucherRepository
 * @package App\Repositories
 * @version March 24, 2022, 12:26 pm IST
*/

class VoucherRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'business_id',
        'code',
        'icon',
        'image',
        'banner_image',
        'category_id',
        'start_date',
        'end_date',
        'terms_eng',
        'description_eng',
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
        return Voucher::class;
    }
}
