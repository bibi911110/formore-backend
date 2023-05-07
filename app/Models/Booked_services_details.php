<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Extra_services",
 *      required={"services_name", "services_per_price", "services_per_point"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="services_name",
 *          description="services_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="services_per_price",
 *          description="services_per_price",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="services_per_point",
 *          description="services_per_point",
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
class Booked_services_details extends Model
{
    use SoftDeletes;

    public $table = 'booked_services_details';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'booking_id',
        'type',
        'product_id',
        'booking_date',
        'product_name_extra',
        'product_time_array',
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'booking_id' => 'integer',
        'type' => 'integer',
        'product_id' => 'integer',
        'booking_date' => 'string',
        'product_name_extra' => 'string',
        'product_time_array' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
       /* 'country_id' => 'required',
        'business_id' => 'required',
        'position' => 'required',*/
        
    ];

    
}
