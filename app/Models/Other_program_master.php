<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Other_program_master",
 *      required={"name", "type_code", "upload_photo", "surname"},
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
 *          property="type_code",
 *          description="type_code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="upload_photo",
 *          description="upload_photo",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="surname",
 *          description="surname",
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
class Other_program_master extends Model
{
    use SoftDeletes;

    public $table = 'other_program_master';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'buss_id',
        'name',
        'type_code',
        'upload_photo',
        'upload_photo_1',
        'barcode_image',
        'qr_code_img',
        'surname'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'buss_id' => 'integer',
        'name' => 'string',
        'type_code' => 'string',
        'upload_photo' => 'string',
        'upload_photo_1' => 'string',
        'barcode_image' => 'string',
        'qr_code_img' => 'string',
        
        'surname' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        /*'name' => 'required',
        'type_code' => 'required',*/
        /*'upload_photo' => 'required',
        'upload_photo_1' => 'required',
        'barcode_image' => 'required',*/
      /*  'surname' => 'required'*/
    ];

    
}
