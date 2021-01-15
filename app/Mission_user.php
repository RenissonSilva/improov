<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mission_user extends Model
{
    protected $table = 'mission_user';

    protected $fillable = [
        'added_xp',
    ];
}
