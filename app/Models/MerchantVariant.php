<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantVariant extends Model
{
    use HasFactory;

    public function has_image(){
        return $this->belongsTo(MerchantProductImages::class, 'image');
    }
    public function linked_product(){
        return $this->belongsTo(MerchantProduct::class, 'product_id');
    }
}
