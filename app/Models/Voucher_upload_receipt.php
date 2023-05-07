<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Voucher_upload_receipt",
 *      required={"business_id", "user_id", "voucher_id", "vat_number", "date_of_purchase", "upload_receipt"},
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
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="voucher_id",
 *          description="voucher_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="vat_number",
 *          description="vat_number",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="date_of_purchase",
 *          description="date_of_purchase",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="time",
 *          description="time",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="upload_receipt",
 *          description="upload_receipt",
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
class Voucher_upload_receipt extends Model
{
    use SoftDeletes;

    public $table = 'voucher_upload_receipt';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'business_id',
        'user_id',
        'voucher_id',
        'vat_number',
        'date_of_purchase',
        'time',
        'status',
        'comment',
        'upload_receipt'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'business_id' => 'integer',
        'user_id' => 'integer',
        'voucher_id' => 'integer',
        'vat_number' => 'string',
        'date_of_purchase' => 'date',
        'time' => 'string',
        'status' => 'string',
        'comment' => 'string',
        'upload_receipt' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        /*'business_id' => 'required',
        'user_id' => 'required',
        'voucher_id' => 'required',
        'vat_number' => 'required',
        'date_of_purchase' => 'required',
        'upload_receipt' => 'required'*/
    ];

    
}
