<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Nfc_master",
 *      required={"nfc_code", "nfc_url", "linked_url"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="nfc_code",
 *          description="nfc_code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="nfc_url",
 *          description="nfc_url",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="linked_url",
 *          description="linked_url",
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
class Nfc_master extends Model
{
    use SoftDeletes;

    public $table = 'nfc_master';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'nfc_code',
        'nfc_url',
        'linked_url',
        'buss_id',
        'notes',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nfc_code' => 'string',
        'nfc_url' => 'string',
        'linked_url' => 'string',
        'buss_id' => 'string',
        'notes' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nfc_code' => 'required',
        'nfc_url' => 'required',
        'linked_url' => 'required',
        'buss_id' => 'required',
        'notes' => 'required'
    ];

    
}
