<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Car;
class user extends Authenticatable
{
    use Notifiable;

    public function cars(){
        return $this->hasMany(Car::class);
    }

    public function permission(){
        return $this->hasOne(UserPermission::class);
    }


    public function isAdmin(){
        return $this->id ==21;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
        'name', 'email', 'password', 'surname', 'birth_date', 'phone_number', 'student_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


}
