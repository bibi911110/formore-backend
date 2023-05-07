<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="User_voucher",
 *      required={"voucher_id", "user_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="voucher_id",
 *          description="voucher_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_credit",
 *          description="user_credit",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="stamps",
 *          description="stamps",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="points",
 *          description="points",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="used_code_status",
 *          description="used_code_status",
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
class User_voucher extends Model
{
    use SoftDeletes;

    public $table = 'user_wallet';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'voucher_id',
        'user_id',
        'assigned_user_id',
        'user_credit',
        'stamps',
        'points',
        'used_code_status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'voucher_id' => 'integer',
        'user_id' => 'integer',
        'assigned_user_id' => 'integer',
        'user_credit' => 'integer',
        'stamps' => 'integer',
        'points' => 'integer',
        'used_code_status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'voucher_id' => 'required',
        'user_id' => 'required'
    ];

    
}
