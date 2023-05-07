<?php

namespace App\Repositories;

use App\Models\Segment;
use App\Repositories\BaseRepository;

/**
 * Class SegmentRepository
 * @package App\Repositories
 * @version February 26, 2022, 3:01 pm IST
*/

class SegmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'segment_name',
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
        return Segment::class;
    }
}
