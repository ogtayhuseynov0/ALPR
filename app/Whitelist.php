<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Whitelist extends Model
{
    protected $fillable = [
      'licence_plate', 'from', 'to'
    ];
}
