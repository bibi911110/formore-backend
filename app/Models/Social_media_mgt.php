<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Social_media_mgt",
 *      required={"media_name", "media_category"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="media_name",
 *          description="media_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="media_category",
 *          description="media_category",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="media_icon",
 *          description="media_icon",
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
class Social_media_mgt extends Model
{
    use SoftDeletes;

    public $table = 'social_media_mgt';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'media_name',
        'media_category',
        'media_icon',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'media_name' => 'string',
        'media_category' => 'string',
        'media_icon' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'media_name' => 'required',
        'media_category' => 'required'
    ];

    
}
