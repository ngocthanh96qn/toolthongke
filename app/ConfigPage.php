<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigPage extends Model
{
       protected $fillable = [
        'user_id', 'name_page', 'utm_medium','utm_source','view_id', 'check','username'
    ];
}
