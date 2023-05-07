<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use  \App\User;

/**
 * @SWG\Definition(
 *      definition="Brand",
 *      required={"cat_id", "sub_id", "name", "brand_icon"},
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
 *          property="sub_id",
 *          description="sub_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="brand_icon",
 *          description="brand_icon",
 *          type="string"
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
class Brand extends Model
{
    use SoftDeletes;

    public $table = 'brand';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'type',
        'stamp_point',
        /*'position',*/
        'cat_id',
        'sub_id',
        'country_id',
        'city_name',
        'currency',
        'services',
        'name',
        'brand_icon',
        'other_program_icon',
        'other_program',
        'latitude',
        'longitude',
        'agreement_date_of_expiry',
        'package_details',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => 'integer',
       /* 'position' => 'integer',*/
        'stamp_point' => 'integer',
        'cat_id' => 'integer',
        'sub_id' => 'integer',
        'country_id' => 'integer',
        'city_name' => 'string',
        'currency' => 'integer',
        'services' => 'string',
        'name' => 'string',
        'brand_icon' => 'string',
        'other_program_icon' => 'string',
        'latitude' => 'string',
        'longitude' => 'string',
        'other_program' => 'integer',
        'status' => 'integer',
        'agreement_date_of_expiry' => 'string',
        'package_details' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required',
        'stamp_point' => 'required',
        'cat_id' => 'required',
        'sub_id' => 'required',
        'name' => 'required',
        'brand_icon' => 'required',
        'latitude' => 'required',
        'longitude' => 'required'
        
    ];

    
}
