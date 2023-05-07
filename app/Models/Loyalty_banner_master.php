<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Loyalty_banner_master",
 *      required={"terms_of_loyalty", "schema"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="terms_of_loyalty",
 *          description="terms_of_loyalty",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="schema",
 *          description="schema",
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
class Loyalty_banner_master extends Model
{
    use SoftDeletes;

    public $table = 'loyalty_banner_master';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'terms_of_loyalty',
        'banner_img',
        'schema'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'terms_of_loyalty' => 'string',
        'banner_img' => 'string',
        'schema' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'terms_of_loyalty' => 'required',
        'schema' => 'required',
        'banner_img' => 'required'
    ];

    
}
