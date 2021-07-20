<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nickname', 'email', 'github_id', 'image', 'level','dateUpLevel','totalRepos',
        'experiencia','totalCommits', 'bio','ultimaAtualizacao', 'github_last_update'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function mission()
    {
        return $this->belongsToMany(Mission::class)->withTimestamps();
    }

    public function repo()
    {
        return $this->hasMany(Repository::class);
    }

    public function mission_user()
    {
        return $this->hasMany(Mission_user::class);
    }

    public function commits()
    {
        return $this->hasMany(Commit::class);
    }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
