<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function hasVariants()
    {
        return $this->hasMany('App\Models\Variant');
    }

    public function has_images()
    {
        return $this->hasMany('App\Models\ProductImage', 'product_id');
    }

    public function has_categories()
    {
        return $this->belongsToMany('App\Models\Category', 'product_categories', 'product_id', 'category_id');
    }

    public function has_subcategories()
    {
        return $this->belongsToMany('App\Models\SubCategory', 'product_sub_categories', 'product_id', 'subcategory_id');
    }
    public function has_status(){
        return $this->belongsTo('App\Models\ProductStatus', 'admin_status');
    }
    public function imported_product(){
        return $this->hasOne('App\Models\MerchantProduct','linked_product_id', 'id');
    }
}
