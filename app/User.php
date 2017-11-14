<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Test;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $casts = [
        'tests' => 'array'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['remember_token', 'passwordConfirmation', 'id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'passwordConfirmation', 'password'
    ];

    public function allTests(){
        return $this->hasMany(Test::class);
    }

    public function getAdminAttribute($admin)
    {
        return (bool) $admin;
    }

    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return ['user' => [
            'id' => $this->id,
            'name' => $this->name,
            'admin' => $this->admin
        ]];
    }
}
