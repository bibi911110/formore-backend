<?php

namespace App\Repositories;

use App\Models\Question_answer;
use App\Repositories\BaseRepository;

/**
 * Class Question_answerRepository
 * @package App\Repositories
 * @version March 16, 2022, 11:49 am IST
*/

class Question_answerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'question_id',
        'select_ans',
        'range_ans',
        'rating_ans',
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
        return Question_answer::class;
    }
}
