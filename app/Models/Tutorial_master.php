<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Tutorial_master",
 *      required={"title", "details", "tutorial_video"},
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
 *          property="tutorial_video",
 *          description="tutorial_video",
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
class Tutorial_master extends Model
{
    use SoftDeletes;

    public $table = 'tutorial_master';
    


    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'language_id',
        'youtube_url',

        'details',

        'tutorial_video',

        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'language_id' => 'integer',

        'title' => 'string',
        'youtube_url' => 'string',

        'details' => 'string',

        'tutorial_video' => 'string',

        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',

        'details' => 'required',

        'tutorial_video' => 'required'
    ];

    
}
