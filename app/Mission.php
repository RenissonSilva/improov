<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable = [
        'name', 'criador', 'ativo', 'repeat_mission'
    ];
}
