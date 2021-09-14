<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;
    public function hasCategory(){
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
    public function has_image(){
        return $this->belongsTo('App\Models\ProductImage', 'image_id');
    }
    public function linked_product(){
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
