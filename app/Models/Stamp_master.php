<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Stamp_master",
 *      required={"business_id", "country_id", "stapm_point", "image_of_loyalty_card", "setup_level", "daily_limit", "welcome_stamp", "birthday_step", "bonus_stamp", "stapm_expired", "point_per_stamp", "currency", "ration_of_cash_out"},
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
 *          property="country_id",
 *          description="country_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="stapm_point",
 *          description="stapm_point",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="image_of_loyalty_card",
 *          description="image_of_loyalty_card",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="setup_level",
 *          description="setup_level",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="daily_limit",
 *          description="daily_limit",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="welcome_stamp",
 *          description="welcome_stamp",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="birthday_step",
 *          description="birthday_step",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="bonus_stamp",
 *          description="bonus_stamp",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="stapm_expired",
 *          description="stapm_expired",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="point_per_stamp",
 *          description="point_per_stamp",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="currency",
 *          description="currency",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="ration_of_cash_out",
 *          description="ration_of_cash_out",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="message_eng",
 *          description="message_eng",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="message_italian",
 *          description="message_italian",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="message_greek",
 *          description="message_greek",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="message_albanian",
 *          description="message_albanian",
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
class Stamp_master extends Model
{
    use SoftDeletes;

    public $table = 'stamp_master';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'business_id',
        'country_id',
        //'nfc_code',
        'transaction_type',
        'stapm_point',
        'image_of_loyalty_card',
        'setup_level',
        'daily_limit',
        'welcome_stamp',
        'birthday_step',
        'bonus_stamp',
        'stapm_expired',
        'point_per_stamp',
        'currency',
        'ration_of_cash_out',
        'message_eng',
        'message_italian',
        'message_greek',
        'message_albanian',
        'color',
        'font_size',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'business_id' => 'integer',
        'country_id' => 'integer',
       // 'nfc_code' => 'string',
        'transaction_type' => 'integer',
        'stapm_point' => 'integer',
        'image_of_loyalty_card' => 'string',
        'setup_level' => 'string',
        'daily_limit' => 'string',
        'welcome_stamp' => 'string',
        'birthday_step' => 'string',
        'bonus_stamp' => 'string',
        'stapm_expired' => 'string',
        'point_per_stamp' => 'string',
        'currency' => 'integer',
        'ration_of_cash_out' => 'string',
        'message_eng' => 'string',
        'message_italian' => 'string',
        'message_greek' => 'string',
        'message_albanian' => 'string',
        'color' => 'string',
        'font_size' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'business_id' => 'required',
        //'country_id' => 'required',
       'transaction_type' => 'required',
        'image_of_loyalty_card' => 'required',
        'setup_level' => 'required',
        'daily_limit' => 'required',
        'welcome_stamp' => 'required',
        'birthday_step' => 'required',
        'bonus_stamp' => 'required',
        'stapm_expired' => 'required',
        'point_per_stamp' => 'required',
       // 'currency' => 'required',
        'ration_of_cash_out' => 'required',
        'color' => 'required',
        'font_size' => 'required',
    ];

    
}
