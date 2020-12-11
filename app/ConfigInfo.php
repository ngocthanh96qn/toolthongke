<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigInfo extends Model
{
   protected $fillable = [
        'user_id', 'id_nv', 'phone_nv','team_nv'
    ];
}
