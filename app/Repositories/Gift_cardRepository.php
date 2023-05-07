<?php

namespace App\Repositories;

use App\Models\Gift_card;
use App\Repositories\BaseRepository;

/**
 * Class Gift_cardRepository
 * @package App\Repositories
 * @version March 30, 2022, 3:37 pm IST
*/

class Gift_cardRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'to_name',
        'to_email',
        'from_name',
        'message',
        'voucher_id',
        'user_id',
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
        return Gift_card::class;
    }
}
