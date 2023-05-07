<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Transaction_history extends Model
{
    public $table = 'transaction_history';  
    protected $fillable = ['user_id','nfc_code','buss_id','stamps','setup_level','point_per_stamp','transaction_type_id','type','old_point','current_point','cash_out_points'];
}
