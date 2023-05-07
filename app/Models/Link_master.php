<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Link_master",
 *      required={"term_link", "privacy_link"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="term_link",
 *          description="term_link",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="privacy_link",
 *          description="privacy_link",
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
class Link_master extends Model
{
    use SoftDeletes;

    public $table = 'link_master';
    


    protected $dates = ['deleted_at'];



    public $fillable = [
        'eng_language_id',
        'term_link',
        'privacy_link',
        'albanian_language_id',
        'albanian_term_link',
        'albanian_privacy_link',
        'greek_language_id',
        'greek_term_link',
        'greek_privacy_link',
        'italian_language_id',
        'italian_term_link',
        'italian_privacy_link',

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'eng_language_id' => 'integer',
        'term_link' => 'string',
        'privacy_link' => 'string',
        'albanian_language_id' => 'integer',
        'albanian_term_link' => 'string',
        'albanian_privacy_link' => 'string',
        'greek_language_id' => 'integer',
        'greek_term_link' => 'string',
        'greek_privacy_link' => 'string',
        'italian_language_id' => 'integer',
        'italian_term_link' => 'string',
        'italian_privacy_link' => 'string',

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'term_link' => 'required',

        'privacy_link' => 'required'
    ];

    
}
