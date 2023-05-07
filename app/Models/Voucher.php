<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Voucher",
 *      required={"business_id", "code", "icon", "image", "banner_image", "category_id", "start_date", "end_date", "terms_eng", "description_eng", "status"},
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
 *          property="code",
 *          description="code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="icon",
 *          description="icon",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="image",
 *          description="image",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="banner_image",
 *          description="banner_image",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="category_id",
 *          description="category_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="start_date",
 *          description="start_date",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="end_date",
 *          description="end_date",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="terms_eng",
 *          description="terms_eng",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description_eng",
 *          description="description_eng",
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
class Voucher extends Model
{
    use SoftDeletes;

    public $table = 'voucher';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'business_id',
        'days',
        'code',
        'icon',
        'image',
        'banner_image',
        'category_id',
        'country_id',
        'campaign_type',
        'campaign_code',
        'levels_based_on_scenarios',
        'campaign_sub_type',
        'campaign_start_date',
        'campaign_end_date',
        'date_of_campaign',
        'max_member',
        'start_date',
        'end_date',
        'title_eng',
        'title_italian',
        'title_greek',
        'title_albanian',
        'terms_eng',
        'terms_italian',
        'terms_greek',
        'terms_albanian',
        'description_eng',
        'description_italian',
        'description_greek',
        'description_albanian',
        'bar_code_image',
        'qr_code',
        'text_for_not_win_code_eng',
        'text_for_not_win_code_italian',
        'text_for_not_win_code_greek',
        'text_for_not_win_code_albanian',
        'text_for_win_code_eng',
        'text_for_win_code_italian',
        'text_for_win_code_greek',
        'text_for_win_code_albanian',
        'status',
        'point_value',
        'stamp',
        'random_win_status',
        'scenario_type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'business_id' => 'integer',
        'days' => 'string',
        'country_id' => 'integer',
        'code' => 'string',
        'icon' => 'string',
        'image' => 'string',
        'banner_image' => 'string',
        'category_id' => 'integer',
        'campaign_type' => 'string',
        'campaign_code' => 'string',
        'levels_based_on_scenarios' => 'integer',
        'campaign_sub_type' => 'string',
        'campaign_start_date' => 'date',
        'campaign_end_date' => 'date',
        'date_of_campaign' => 'date',
        'start_date' => 'date',
        'max_member' => 'integer',
        'end_date' => 'date',
        'title_eng' => 'string',
        'title_italian' => 'string',
        'title_greek' => 'string',
        'title_albanian' => 'string',
        'terms_eng' => 'string',
        'terms_italian' => 'string',
        'terms_greek' => 'string',
        'terms_albanian' => 'string',
        'description_eng' => 'string',
        'description_italian' => 'string',
        'description_greek' => 'string',
        'description_albanian' => 'string',
        'bar_code_image' => 'string',
        'qr_code' => 'string',
        'status' => 'integer',
        'random_win_status'=> 'integer',
        'scenario_type'=> 'integer',
        'text_for_not_win_code_eng' => 'string',
        'text_for_not_win_code_italian' => 'string',
        'text_for_not_win_code_greek' => 'string',
        'text_for_not_win_code_albanian' => 'string',
        'text_for_win_code_eng' => 'string',
        'text_for_win_code_italian' => 'string',
        'text_for_win_code_greek' => 'string',
        'text_for_win_code_albanian' => 'string',
        'point_value' => 'integer',
        'stamp' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        /*'business_id' => 'required',
        'code' => 'required',
        'icon' => 'required',
        'image' => 'required',
        'banner_image' => 'required',
        'category_id' => 'required',
        'start_date' => 'required',
        'end_date' => 'required',*/
    ];

    
}
