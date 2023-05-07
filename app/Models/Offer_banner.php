<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Offer_banner",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="offer_image",
 *          description="offer_image",
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
class Offer_banner extends Model
{
    use SoftDeletes;

    public $table = 'offer_banner';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'offer_image',
        'deals_banner_image',
        'title_for_deals',
        'cat_id',
        'description_eng',
        'description_italian',
        'description_greek',
        'description_albanian',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'offer_image' => 'string',
        'deals_banner_image' => 'string',
        'title_for_deals' => 'string',
        'cat_id' => 'integer',
        'description_eng' => 'string',
        'description_italian' => 'string',
        'description_greek' => 'string',
        'description_albanian' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
