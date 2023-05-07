<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Services_product",
 *      required={"name", "product_img", "price_per_slot", "point_per_slot"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
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
 *          property="price_per_slot",
 *          description="price_per_slot",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="point_per_slot",
 *          description="point_per_slot",
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
class Services_product extends Model
{
    use SoftDeletes;

    public $table = 'services_product';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'cat_id',
        'product_img',
        'price_per_slot',
        'point_per_slot',
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
        'cat_id' => 'integer',
        'name' => 'string',
        'product_img' => 'string',
        'price_per_slot' => 'string',
        'point_per_slot' => 'integer',
        'created_by' => 'integer',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'product_img' => 'required',
        'price_per_slot' => 'required',
        'point_per_slot' => 'required'
    ];

    
}
