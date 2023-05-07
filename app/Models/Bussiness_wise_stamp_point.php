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
class Bussiness_wise_stamp_point extends Model
{
    use SoftDeletes;

    public $table = 'bussiness_wise_stamp_point';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'business_id',
        'user_id',
        'total_stamp',
        'total_point',
        
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'business_id' => 'integer',
        'user_id' => 'integer',
        'total_stamp' => 'integer',
        'total_point' => 'string',
        
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
