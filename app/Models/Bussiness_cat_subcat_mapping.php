<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Country",
 *      required={"country_name", "country_code"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="country_name",
 *          description="country_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="country_code",
 *          description="country_code",
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
class Bussiness_cat_subcat_mapping extends Model
{
    use SoftDeletes;

    public $table = 'bussiness_cat_subcat_mapping';
    


    //protected $dates = ['deleted_at'];



    public $fillable = [
        'business_id',
        'cat_id',
        'sub_cat_id',
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'business_id' => 'integer',
        'cat_id' => 'integer',
        'sub_cat_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    /*public static $rules = [
        'country_name' => 'required',
        'country_code' => 'required'
    ];*/

    
}
