<?php

namespace App\Repositories;

use App\Models\Points_master;
use App\Repositories\BaseRepository;

/**
 * Class Points_masterRepository
 * @package App\Repositories
 * @version April 6, 2022, 9:12 am IST
*/

class Points_masterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'schema',
        'currency_id',
        'ratio_of_collecting_points',
        'ratio_for_cash_out',
        'segments_id',
        'levels_based_on_scenarios',
        'birthday',
        'welcome',
        'fraud_of_points',
        'campaign',
        'start_date',
        'end_date',
        'choose_segments',
        'expiration_date',
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
        return Points_master::class;
    }
}
