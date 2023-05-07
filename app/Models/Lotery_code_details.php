<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Voucher_category",
 *      required={"voucher_category"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="voucher_category",
 *          description="voucher_category",
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
class Lotery_code_details extends Model
{
    use SoftDeletes;

    public $table = 'lotery_code_details';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'voucher_id',
        'lotery_code',
        'bar_code',
        'qr_code_image',
        'user_id',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'voucher_id' => 'integer',
        'lotery_code' => 'string',
        'bar_code' => 'string',
        'qr_code_image'=> 'string',
        'user_id' => 'integer',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        //'voucher_category' => 'required'
    ];

    
}
