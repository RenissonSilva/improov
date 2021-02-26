<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable = [
        'name', 'criador', 'is_active', 'repeat_mission'
    ];
}
