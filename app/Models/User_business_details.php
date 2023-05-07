<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="User_business_details",
 *      required={"user_id", "header_banner", "business_name", "map_link", "user_available_points", "e_shop_banner", "booking_banner", "logo"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="header_banner",
 *          description="header_banner",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="business_name",
 *          description="business_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="map_link",
 *          description="map_link",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="user_available_points",
 *          description="user_available_points",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="e_shop_banner",
 *          description="e_shop_banner",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="booking_banner",
 *          description="booking_banner",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="logo",
 *          description="logo",
 *          type="string"
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
class User_business_details extends Model
{
    use SoftDeletes;

    public $table = 'user_business_details';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'header_banner',
        'business_name',
        'map_link',
        'user_available_points',
        'e_shop_banner',
        'booking_banner',
        'logo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'string',
        'header_banner' => 'string',
        'business_name' => 'string',
        'map_link' => 'string',
        'user_available_points' => 'float',
        'e_shop_banner' => 'string',
        'booking_banner' => 'string',
        'logo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        /*'user_id' => 'required',
        'header_banner' => 'required',
        'business_name' => 'required',
        'map_link' => 'required',
        'user_available_points' => 'required',
        'e_shop_banner' => 'required',
        'booking_banner' => 'required',
        'logo' => 'required'*/
    ];

    
}
