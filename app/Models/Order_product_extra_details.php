<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Order_product_extra_details",
 *      required={"product_id", "name", "available_quantities", "points_per_quantity", "price_per_quantity"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="product_id",
 *          description="product_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="available_quantities",
 *          description="available_quantities",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="points_per_quantity",
 *          description="points_per_quantity",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="price_per_quantity",
 *          description="price_per_quantity",
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
class Order_product_extra_details extends Model
{
    use SoftDeletes;

    public $table = 'order_product_extra_details';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'product_id',
        'name',
        'available_quantities',
        'points_per_quantity',
        'price_per_quantity',
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
        'product_id' => 'integer',
        'name' => 'string',
        'available_quantities' => 'integer',
        'points_per_quantity' => 'integer',
        'price_per_quantity' => 'string',
        'created_by' => 'integer',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'required',
        'name' => 'required',
        'available_quantities' => 'required',
        'points_per_quantity' => 'required',
        'price_per_quantity' => 'required'
    ];

    
}
