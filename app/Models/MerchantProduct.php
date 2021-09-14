<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantProduct extends Model
{
    use HasFactory;
    public function hasVariants(){
        return $this->hasMany('App\Models\MerchantVariant','product_id');
    }
    public function has_images(){
        return $this->hasMany('App\Models\MerchantProductImages','product_id');
    }
    public function has_categories(){
        return $this->belongsToMany('App\Models\Category','retailer_product_category','product_id','category_id');
    }
    public function has_subcategories(){
        return $this->belongsToMany('App\SubCategory','retailer_product_subcategory','product_id','subcategory_id');
    }

    public function linked_product(){
        return $this->belongsTo('App\Models\Product','linked_product_id');
    }

    public function has_shop() {
        return $this->belongsTo('App\Models\User', 'shop_id');
    }

}
