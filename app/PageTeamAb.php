<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageTeamAb extends Model
{
    protected $fillable = [
        'page_name', 'user_name','user_id'
    ];
}
