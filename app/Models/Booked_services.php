<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Booked_services",
 *      required={"member_name", "member_id", "service_name", "booking_service_date_time", "comments", "advance_payment"},
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
 *          property="service_name",
 *          description="service_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="booking_service_date_time",
 *          description="booking_service_date_time",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="comments",
 *          description="comments",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="advance_payment",
 *          description="advance_payment",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_by",
 *          description="created_by",
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
class Booked_services extends Model
{
    use SoftDeletes;

    public $table = 'booked_services';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'booking_id',
        //'product_id',
         'finalpoints',
        'finalcash',
        'coupocode',
        'member_name',
        'member_id',
        'service_name',
        'booking_service_date_time',
        'comments',
        'advance_payment',
        'view_notification_status',
        'view_buss_user_notification_status',
        'status',
        'created_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
       // 'product_id' => 'integer',
        'finalpoints' => 'integer',
        'finalcash' => 'string',
        'booking_id' => 'integer',
        'member_name' => 'string',
        'member_id' => 'string',
        'service_name' => 'string',
        'booking_service_date_time' => 'date',
        'comments' => 'string',
        'advance_payment' => 'string',
        'view_notification_status' => 'integer',
        'view_buss_user_notification_status' =>'integer',
        'status' => 'string',
        'created_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
       /* 'member_name' => 'required',
        'member_id' => 'required',
        'service_name' => 'required',
        'booking_service_date_time' => 'required',
        'comments' => 'required',
        'advance_payment' => 'required'*/
    ];

    
}
