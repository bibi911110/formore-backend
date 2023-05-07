<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Gift_card",
 *      required={"to_name", "to_email", "from_name", "message", "voucher_id", "user_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="to_name",
 *          description="to_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="to_email",
 *          description="to_email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="from_name",
 *          description="from_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="message",
 *          description="message",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="voucher_id",
 *          description="voucher_id",
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
class Gift_card extends Model
{
    use SoftDeletes;

    public $table = 'gift_card';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'to_name',
        'to_email',
        'from_name',
        'message',
        'voucher_id',
        'to_user_id',
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
        'to_name' => 'string',
        'to_email' => 'string',
        'from_name' => 'string',
        'message' => 'string',
        'voucher_id' => 'integer',
        'to_user_id' => 'integer',
        'user_id' => 'integer',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'to_name' => 'required',
        'to_email' => 'required',
        'from_name' => 'required',
        'message' => 'required',
        'voucher_id' => 'required',
        'user_id' => 'required'
    ];    
}
