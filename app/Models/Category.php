<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Category",
 *      required={"name", "icon"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="icon",
 *          description="icon",
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
class Category extends Model
{
    use SoftDeletes;

    public $table = 'category';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'cat_italian',
        'cat_greek',
        'cat_albanian',
        'icon',
        'position',
        'business_id_1',
        'position_1',
        'business_id_2',
        'position_2',
        'business_id_3',
        'position_3',
        'business_id_4',
        'position_4',
        'business_id_5',
        'position_5',
        'business_id_6',
        'position_6',
        'business_id_7',
        'position_7',
        'business_id_8',
        'position_8',
        'business_id_9',
        'position_9',
        'business_id_10',
        'position_10',
        'position',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'position' => 'string',
        'business_id_1' => 'integer',
        'position_1' => 'integer',
        'business_id_2' => 'integer',
        'position_2' => 'integer',
        'business_id_3' => 'integer',
        'position_3' => 'integer',
        'business_id_4' => 'integer',
        'position_4' => 'integer',
        'business_id_5' => 'integer',
        'position_5' => 'integer',
        'business_id_6' => 'integer',
        'position_6' => 'integer',
        'business_id_7' => 'integer',
        'position_7' => 'integer',
        'business_id_8' => 'integer',
        'position_8' => 'integer',
        'business_id_9' => 'integer',
        'position_9' => 'integer',
        'business_id_10' => 'integer',
        'position_10' => 'integer',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'cat_italian' => 'required',
        'cat_greek' => 'required',
        'cat_albanian' => 'required',
        'position' => 'required',
        'icon' => 'required'
    ];

    
}
