<?php

namespace App\Repositories;

use App\Models\Flag_selection;
use App\Repositories\BaseRepository;

/**
 * Class Flag_selectionRepository
 * @package App\Repositories
 * @version April 8, 2022, 8:51 am IST
*/

class Flag_selectionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'buss_id',
        'segment_id',
        'user_id'
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
        return Flag_selection::class;
    }
}
