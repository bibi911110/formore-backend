<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Points_master",
 *      required={"schema", "currency_id", "ratio_of_collecting_points", "ratio_for_cash_out", "segments_id", "levels_based_on_scenarios", "birthday", "welcome", "fraud_of_points"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="schema",
 *          description="schema",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="currency_id",
 *          description="currency_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="ratio_of_collecting_points",
 *          description="ratio_of_collecting_points",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="ratio_for_cash_out",
 *          description="ratio_for_cash_out",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="segments_id",
 *          description="segments_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="levels_based_on_scenarios",
 *          description="levels_based_on_scenarios",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="birthday",
 *          description="birthday",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="welcome",
 *          description="welcome",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="fraud_of_points",
 *          description="fraud_of_points",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="campaign",
 *          description="campaign",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="start_date",
 *          description="start_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="end_date",
 *          description="end_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="choose_segments",
 *          description="choose_segments",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="expiration_date",
 *          description="expiration_date",
 *          type="string",
 *          format="date"
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
class Points_master extends Model
{
    use SoftDeletes;

    public $table = 'points_master';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
         'business_id',
        'country_id',
        'color',
        'font_size',
        'image_of_loyalty_card',
        'schema',
        'win_direct_point',
        'currency_id',
        'ratio_of_collecting_points',
        'ratio_for_cash_out',
        //'segments_id',
        'levels_based_on_scenarios',
        'levels_based_amount_0',
        'levels_based_amount_1',
        'levels_based_amount_2',
        'levels_based_amount_3',
        'levels_based_amount_4',
        'birthday',
        'birth_point',
        'birth_segments_id',
        'welcome',
        'welcome_point',
        'welcome_segments_id',
        'transactions_means',
        'duration',
        'points_limits',
        'campaign',
        'start_date',
        'end_date',
        'amount_type',
        'c_amount',
        'c_percentage',
        'c_segments_id',
       // 'choose_segments',
        'expiration_date',
        'message_eng',
        'message_italian',
        'message_greek',
        'message_albanian'
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
        'color' => 'string',
        'font_size' => 'string',
        'image_of_loyalty_card' => 'string',
        'schema' => 'string',
        'win_direct_point' => 'integer',
        'currency_id' => 'integer',
        'ratio_of_collecting_points' => 'string',
        'ratio_for_cash_out' => 'string',
       // 'segments_id' => 'integer',
        'levels_based_on_scenarios' => 'string',
        'levels_based_amount_0' => 'integer',
        'levels_based_amount_1' => 'integer',
        'levels_based_amount_2' => 'integer',
        'levels_based_amount_3' => 'integer',
        'levels_based_amount_4' => 'integer',
        'birthday' => 'string',
        'birth_point' => 'string',
        'birth_segments_id' => 'string',
        'welcome' => 'string',
        'welcome_point' => 'string',
        'welcome_segments_id' => 'string',
        //'fraud_of_points' => 'string',
        'transactions_means' => 'string',
        'duration' => 'string',
        'points_limits' => 'string',
        'campaign' => 'string',
        'start_date' => 'date',
        'end_date' => 'date',
        'choose_segments' => 'string',
        'expiration_date' => 'date',
        'message_eng' => 'string',
        'message_italian' => 'string',
        'message_greek' => 'string',
        'message_albanian' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'business_id' => 'required',
        //'country_id' => 'required',
        'schema' => 'required',
       // 'currency_id' => 'required',
        'ratio_of_collecting_points' => 'required',
        'ratio_for_cash_out' => 'required',
       // 'segments_id' => 'required',
        // 'levels_based_on_scenarios' => 'required',
        'birthday' => 'required',
        'welcome' => 'required',
       //    'fraud_of_points' => 'required'
    ];

    
}
