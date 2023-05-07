<?php

namespace App\Repositories;

use App\Models\Rating;
use App\Repositories\BaseRepository;

/**
 * Class RatingRepository
 * @package App\Repositories
 * @version March 13, 2022, 11:57 am IST
*/

class RatingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'rating_no',
        'comment',
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
        return Rating::class;
    }
}
