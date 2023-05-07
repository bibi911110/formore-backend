<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Refer_business",
 *      required={"title", "refer_icon", "refer_text", "term_details"},
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
 *          property="refer_icon",
 *          description="refer_icon",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="refer_text",
 *          description="refer_text",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="term_details",
 *          description="term_details",
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
class Refer_business extends Model
{
    use SoftDeletes;

    public $table = 'refer_business';
    


    protected $dates = ['deleted_at'];



    public $fillable = [

        'refer_icon',
        'refer_icon1',
        'refer_icon2',
        'eng_language_id',
        'title',
        'refer_text',
        'refer_text1',
        'refer_text2',
        'term_details',
        'albanian_language_id',
        'albanian_title',
        'albanian_refer_text',
        'albanian_refer_text1',
        'albanian_refer_text2',
        'albanian_term_details',
        'greek_language_id',
        'greek_title',
        'greek_refer_text',
        'greek_refer_text1',
        'greek_refer_text2',
        'greek_term_details',
        'italian_language_id',
        'italian_title',
        'italian_refer_text',
        'italian_refer_text1',
        'italian_refer_text2',
        'italian_term_details',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'refer_icon' => 'string',
        'refer_icon1' => 'string',
        'refer_icon2' => 'string',
        'eng_language_id' => 'integer',
        'title' => 'string',
        'refer_text' => 'string',
        'refer_text1' => 'string',
        'refer_text2' => 'string',
        'term_details' => 'string',
        'albanian_language_id' => 'integer',
        'albanian_title' => 'string',
        'albanian_refer_text' => 'string',
        'albanian_refer_text1' => 'string',
        'albanian_refer_text2' => 'string',
        'albanian_term_details' => 'string',
        'greek_language_id' => 'integer',
        'greek_title' => 'string',
        'greek_refer_text' => 'string',
        'greek_refer_text1' => 'string',
        'greek_refer_text2' => 'string',
        'greek_term_details' => 'string',
        'italian_language_id' => 'integer',
        'italian_title' => 'string',
        'italian_refer_text' => 'string',
        'italian_refer_text1' => 'string',
        'italian_refer_text2' => 'string',
        'italian_term_details' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',

        'refer_icon' => 'required',

        /*'refer_text' => 'required',*/
        'refer_icon1' => 'required',

        /*'refer_text1' => 'required',*/
        'refer_icon2' => 'required',

        /*'refer_text2' => 'required',*/

        'term_details' => 'required'
    ];

    
}
