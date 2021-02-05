<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckDay extends Model
{
    protected $fillable = [
        'page_id', 'day', 'sl',
    ];
}
