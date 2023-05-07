<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Member_orders",
 *      required={"member_name", "member_id", "order_details", "delivery_address", "member_comments", "advance_payment"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="member_name",
 *          description="member_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="member_id",
 *          description="member_id",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="order_details",
 *          description="order_details",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="delivery_address",
 *          description="delivery_address",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="member_comments",
 *          description="member_comments",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="advance_payment",
 *          description="advance_payment",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="points",
 *          description="points",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="cash",
 *          description="cash",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="string"
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
class Member_orders extends Model
{
    use SoftDeletes;

    public $table = 'member_orders';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'order_id',
        /*'product_id',*/
        'finalpoints',
        'finalcash',
        'coupocode',
        'member_name',
        'member_id',
        'order_details',
        'delivery_address',
        'member_comments',
        'advance_payment',
        'points',
        'cash',
        'storepick',
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
        'order_id' => 'integer',
        'finalpoints' => 'integer',
        'finalcash' => 'integer',
        /*'product_id' => 'integer',*/
        'coupocode' => 'integer',
        'member_name' => 'string',
        'member_id' => 'string',
        'order_details' => 'string',
        'delivery_address' => 'string',
        'advance_payment' => 'string',
        'points' => 'integer',
        'cash' => 'string',
        'created_by' => 'integer',
        'storepick' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        /*'member_name' => 'required',
        'member_id' => 'required',
        'order_details' => 'required',
        'delivery_address' => 'required',
        'member_comments' => 'required',
        'advance_payment' => 'required'*/
    ];

    
}
