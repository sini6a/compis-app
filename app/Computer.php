<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    public $timestamps = false;

    public $fillable = [
        'friendly_name', 'processor', 'graphics', 'ram', 'storage', 'os', 'user_id'
    ];
    
    public function services() {
        return $this->hasMany('App\Service');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
