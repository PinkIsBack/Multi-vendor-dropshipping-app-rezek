<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingRoute extends Model
{
    use HasFactory;
    public function origin(){
        return $this->belongsTo('App\Models\City', 'origin_city_id');
    }
    public function destination(){
        return $this->belongsTo('App\Models\City', 'destination_city_id');
    }
}
