<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Slot_master",
 *      required={"start_time", "end_time", "pepole_per_slot", "price_per_slot"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="start_time",
 *          description="start_time",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="end_time",
 *          description="end_time",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="pepole_per_slot",
 *          description="pepole_per_slot",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="price_per_slot",
 *          description="price_per_slot",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_by",
 *          description="created_by",
 *          type="integer",
 *          format="int32"
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
class Slot_master extends Model
{
    use SoftDeletes;

    public $table = 'slot_master';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'start_time',
        'end_time',
        'pepole_per_slot',
        'price_per_slot',
        'created_by',
        'user_id',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'start_time' => 'string',
        'end_time' => 'string',
        'pepole_per_slot' => 'integer',
        'price_per_slot' => 'integer',
        'created_by' => 'integer',
        'user_id' => 'integer',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'start_time' => 'required',
        'end_time' => 'required',
        'pepole_per_slot' => 'required',
        'price_per_slot' => 'required'
    ];

    
}
