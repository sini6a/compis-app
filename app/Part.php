<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'price', 'discount', 'discounted_price', 'service_id'
    ];
}
