<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Refer_business_details",
 *      required={"name_of_business", "owner_email", "your_name", "your_email", "term_check"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name_of_business",
 *          description="name_of_business",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="owner_email",
 *          description="owner_email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="your_name",
 *          description="your_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="your_email",
 *          description="your_email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="term_check",
 *          description="term_check",
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
class Refer_business_details extends Model
{
    use SoftDeletes;

    public $table = 'refer_business_details';
    


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name_of_business',

        'owner_email',

        'your_name',

        'your_email',

        'term_check',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',

        'name_of_business' => 'string',

        'owner_email' => 'string',

        'your_name' => 'string',

        'your_email' => 'string',

        'term_check' => 'integer',
        'status' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        /*'name_of_business' => 'required',

        'owner_email' => 'required',

        'your_name' => 'required',

        'your_email' => 'required',

        'term_check' => 'required'*/
    ];

    
}
