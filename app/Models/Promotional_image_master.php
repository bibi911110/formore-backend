<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Promotional_image_master",
 *      required={"image_1", "counter_1", "image_2", "counter_2", "image_3", "counter_3", "image_4", "counter_4", "image_5", "counter_5", "from_date", "to_date"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="image_1",
 *          description="image_1",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="counter_1",
 *          description="counter_1",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="image_2",
 *          description="image_2",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="counter_2",
 *          description="counter_2",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="image_3",
 *          description="image_3",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="counter_3",
 *          description="counter_3",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="image_4",
 *          description="image_4",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="counter_4",
 *          description="counter_4",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="image_5",
 *          description="image_5",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="counter_5",
 *          description="counter_5",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="from_date",
 *          description="from_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="to_date",
 *          description="to_date",
 *          type="string",
 *          format="date"
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
class Promotional_image_master extends Model
{
    use SoftDeletes;

    public $table = 'promotional_image_master';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'image_1',
        'counter_1',
        'image_2',
        'counter_2',
        'image_3',
        'counter_3',
        'image_4',
        'counter_4',
        'image_5',
        'counter_5',
        'popup_img',
        'from_date',
        'to_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'image_1' => 'string',
        'counter_1' => 'string',
        'image_2' => 'string',
        'counter_2' => 'string',
        'image_3' => 'string',
        'counter_3' => 'string',
        'image_4' => 'string',
        'counter_4' => 'string',
        'image_5' => 'string',
        'counter_5' => 'string',
        'popup_img' => 'string',
        'from_date' => 'date',
        'to_date' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        /*'image_1' => 'required',
        'counter_1' => 'required',
        'image_2' => 'required',
        'counter_2' => 'required',
        'image_3' => 'required',
        'counter_3' => 'required',
        'image_4' => 'required',
        'counter_4' => 'required',
        'image_5' => 'required',
        'counter_5' => 'required',
        'popup_img' => 'required',
        'from_date' => 'required',
        'to_date' => 'required'*/
    ];

    
}
