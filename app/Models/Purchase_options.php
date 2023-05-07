<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Purchase_options",
 *      required={"title", "points"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="available",
 *          description="available",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="points",
 *          description="points",
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
class Purchase_options extends Model
{
    use SoftDeletes;

    public $table = 'purchase_options';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'v_code',
        'title',
        'available',
        'points',
        'code_status',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'v_code' => 'string',
        'title' => 'string',
        'available' => 'string',
        'points' => 'string',
        'code_status' => 'integer',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'v_code' => 'required',
        'title' => 'required',
        'points' => 'required'
    ];

    
}
