<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    protected $fillable = [
        'name', 'main_language', 'link', 'user_id'
    ];
}
