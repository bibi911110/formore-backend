<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Order_products",
 *      required={"cat_id", "name", "product_img", "ingredients_name", "available_quantities", "price_per_quantity", "points_per_quantity"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="cat_id",
 *          description="cat_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="product_img",
 *          description="product_img",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="ingredients_name",
 *          description="ingredients_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="available_quantities",
 *          description="available_quantities",
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
 *          property="points_per_quantity",
 *          description="points_per_quantity",
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
class Order_products extends Model
{
    use SoftDeletes;

    public $table = 'order_products';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'cat_id',
        'product_id',
        'name',
        'product_img',
        'ingredients_name',
        'available_quantities',
        'price_per_quantity',
        'points_per_quantity',
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
        'cat_id' => 'integer',
        'name' => 'string',
        'product_img' => 'string',
        'ingredients_name' => 'string',
        'available_quantities' => 'integer',
        'price_per_quantity' => 'string ',
        'points_per_quantity' => 'integer',
        'created_by' => 'integer',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cat_id' => 'required',
        'name' => 'required',
        'product_img' => 'required',
        'ingredients_name' => 'required',
        'available_quantities' => 'required',
        'price_per_quantity' => 'required',
        'points_per_quantity' => 'required'
    ];

    
}
