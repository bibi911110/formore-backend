<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Notification_master",
 *      required={"title", "details"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="details",
 *          description="details",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="notification_image",
 *          description="notification_image",
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
class Notification_master extends Model
{
    use SoftDeletes;

    public $table = 'notification_master';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'user_id',
        'details',
        'notification_image',
        'comments',
        'status',
        'send_status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'string',
        'title' => 'string',
        'details' => 'string',
        'notification_image' => 'string',
        'comments' => 'string',
        'status' => 'integer',
        'send_status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'title' => 'required',
        'details' => 'required',
        'comments' => 'required'
    ];

    
}
