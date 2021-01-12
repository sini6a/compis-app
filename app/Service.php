<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function computer() {
        return $this->belongsTo('App\Computer');
    }

    protected $fillable = [
        'cost', 'computer_id'
    ];
}
