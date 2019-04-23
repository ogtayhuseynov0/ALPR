<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\user;

class Car extends Model
{
    //
    protected $fillable = [
        'user_id', 'licence_plate', 'color', 'model',
    ];
    public function user(){
        return $this->belongsTo(user::class);
    }
    public function permission(){
        return $this->hasOne(CarPermission::class);
    }
}
