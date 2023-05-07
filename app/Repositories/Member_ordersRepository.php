<?php

namespace App\Repositories;

use App\Models\Member_orders;
use App\Repositories\BaseRepository;

/**
 * Class Member_ordersRepository
 * @package App\Repositories
 * @version May 17, 2022, 11:57 am IST
*/

class Member_ordersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'member_name',
        'member_id',
        'order_details',
        'delivery_address',
        'member_comments',
        'advance_payment',
        'points',
        'cash',
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
        return Member_orders::class;
    }
}
