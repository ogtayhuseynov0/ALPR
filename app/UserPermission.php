<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{

    protected $fillable = [
        'user_id', 'is_allowed',
    ];

    public function user(){
        return $this->belongsTo(user::class);
    }
}
