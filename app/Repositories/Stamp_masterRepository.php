<?php

namespace App\Repositories;

use App\Models\Stamp_master;
use App\Repositories\BaseRepository;

/**
 * Class Stamp_masterRepository
 * @package App\Repositories
 * @version April 5, 2022, 6:37 pm IST
*/

class Stamp_masterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'business_id',
        'country_id',
        'stapm_point',
        'image_of_loyalty_card',
        'setup_level',
        'daily_limit',
        'welcome_stamp',
        'birthday_step',
        'bonus_stamp',
        'stapm_expired',
        'point_per_stamp',
        'currency',
        'ration_of_cash_out',
        'message_eng',
        'message_italian',
        'message_greek',
        'message_albanian'
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
        return Stamp_master::class;
    }
}
