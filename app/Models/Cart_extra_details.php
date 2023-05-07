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
class Cart_extra_details extends Model
{
    use SoftDeletes;

    public $table = 'cart_extra_details';
    

    protected $dates = ['deleted_at'];

    public $fillable = [
        'type',
        'extra_id',
        'cart_id',
        'product_id',
        'name',
        'available_quantities',
        'points_per_quantity',
        'price_per_quantity',
        'quantity',
        'user_id',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => 'integer',
        'cart_id' => 'integer',
        'extra_id' => 'integer',
        'product_id' => 'integer',
        'name' => 'string',
        'available_quantities' => 'integer',
        'points_per_quantity' => 'integer',
        'price_per_quantity' => 'string',
        'quantity' => 'integer',
        'user_id' => 'integer',
        'status' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        /*'product_id' => 'required',
        'name' => 'required',
        'available_quantities' => 'required',
        'points_per_quantity' => 'required',
        'price_per_quantity' => 'required'*/
    ];

    
}
