<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public $timestamps = false;

    public function user() {
        return hasMany('App\User');
    }

    protected $fillable = [
        'name', 'price',
    ];
}
