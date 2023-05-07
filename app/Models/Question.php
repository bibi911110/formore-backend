<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Question",
 *      required={"name", "ans_type", "user_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="ans_type",
 *          description="ans_type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
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
class Question extends Model
{
    use SoftDeletes;

    public $table = 'question';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'title',
        'notes',
        'code',
        'q_date',
        'msg_eng',
        'msg_italian',
        'msg_greek',
        'msg_albanian',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'string',
        'title' => 'string',
        'notes' => 'string',
        'code' => 'string',
        'q_date' => 'string',
        'msg_eng' => 'string',
        'msg_italian' => 'string',
        'msg_greek' => 'string',
        'msg_albanian' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        /*'name' => 'required',
        'ans_type' => 'required',*/
        //'user_id' => 'required'
        'title' => 'required',
        'notes' => 'required',
        'code' => 'required',
        'q_date' => 'required',
        'q_date' => 'required',
    ];

    
}
