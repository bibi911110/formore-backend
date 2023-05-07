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
class Notification_all_child extends Model
{
    use SoftDeletes;

    public $table = 'notification_all_child';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'business_id',
        'business_user_id',
        'slug',
        'message',
        'status',
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'business_id' => 'integer',
        'business_user_id' => 'integer',
        'slug' => 'string',
        'message' => 'string',
        'status' => 'integer',
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
