<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tokenPage extends Model
{
    protected $fillable = [
        'token', 'id_page', 'name_page'
    ];
}
