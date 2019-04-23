<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarPermission extends Model
{
    protected $fillable = [
        'l_p', 'is_allowed',
    ];

    public function car(){
        return $this->belongsTo(Car::class);
    }
}
