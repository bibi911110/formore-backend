<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Coupon_master_services",
 *      required={"coupon_code", "start_date", "end_date", "amount_type", "amount", "amount_discount", "points_discount"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="coupon_code",
 *          description="coupon_code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="start_date",
 *          description="start_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="end_date",
 *          description="end_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="amount_type",
 *          description="amount_type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="amount",
 *          description="amount",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="amount_discount",
 *          description="amount_discount",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="points_discount",
 *          description="points_discount",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="coupon_info",
 *          description="coupon_info",
 *          type="string"
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
class Coupon_master_services extends Model
{
    use SoftDeletes;

    public $table = 'coupon_master_services';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'coupon_code',
        'start_date',
        'end_date',
        'amount_type',
        'amount',
        'amount_discount',
        'points_discount',
        'coupon_info',
        'created_by',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'coupon_code' => 'string',
        'start_date' => 'date',
        'end_date' => 'date',
        'amount_type' => 'string',
        'amount' => 'string',
        'amount_discount' => 'integer',
        'points_discount' => 'integer',
        'coupon_info' => 'string',
        'created_by' => 'integer',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'coupon_code' => 'required',
        'start_date' => 'required',
        'end_date' => 'required',
        'amount_type' => 'required',
        'amount' => 'required',
        'amount_discount' => 'required',
        'points_discount' => 'required'
    ];

    
}
