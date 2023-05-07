<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class My_rewards extends Model
{
    public $table = 'my_rewards';  
    protected $fillable = ['user_id','nfc_code','buss_id','stamps','setup_level','point_per_stamp','setup_level_count'];
}
