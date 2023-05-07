<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Question_answer",
 *      required={"question_id", "select_ans", "range_ans", "rating_ans", "user_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="question_id",
 *          description="question_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="select_ans",
 *          description="select_ans",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="range_ans",
 *          description="range_ans",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="rating_ans",
 *          description="rating_ans",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Question_answer extends Model
{
    use SoftDeletes;

    public $table = 'question_answer';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'question_id',
        'select_ans',
        'range_ans',
        'rating_ans',
        'comments',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'question_id' => 'integer',
        'select_ans' => 'string',
        'range_ans' => 'integer',
        'rating_ans' => 'string',
        'comments' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'question_id' => 'required',
        'select_ans' => 'required',
        'range_ans' => 'required',
        'rating_ans' => 'required',
        'user_id' => 'required'
    ];

    
}
