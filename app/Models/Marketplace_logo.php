<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Marketplace_logo",
 *      required={"business_id", "position"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="business_id",
 *          description="business_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="position",
 *          description="position",
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
class Marketplace_logo extends Model
{
    use SoftDeletes;

    public $table = 'marketplace_logo';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'country_id',
        'business_id',
        'cat_id',
        'sub_cat_id',
        'position'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'country_id' => 'integer',
        'business_id' => 'integer',
        'cat_id' => 'integer',
        'sub_cat_id' => 'integer',
        'position' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'country_id' => 'required',
        'business_id' => 'required',
        'cat_id' => 'required',
        'sub_cat_id' => 'required',
        'position' => 'required'
    ];

    
}
