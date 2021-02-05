<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckPost extends Model
{
    protected $fillable = [
        'name', 'page',
    ];
}
