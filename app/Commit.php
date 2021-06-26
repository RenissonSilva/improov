<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commit extends Model
{
    protected $fillable = [
        'id', 'user_id', 'created_at'
    ];
}
