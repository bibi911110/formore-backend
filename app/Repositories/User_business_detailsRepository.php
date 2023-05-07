<?php

namespace App\Repositories;

use App\Models\User_business_details;
use App\Repositories\BaseRepository;

/**
 * Class User_business_detailsRepository
 * @package App\Repositories
 * @version March 13, 2022, 12:09 pm IST
*/

class User_business_detailsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'header_banner',
        'business_name',
        'map_link',
        'user_available_points',
        'e_shop_banner',
        'booking_banner',
        'logo'
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
        return User_business_details::class;
    }
}
