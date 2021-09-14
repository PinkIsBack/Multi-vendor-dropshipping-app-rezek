<?php

namespace App\Models;

use App\Product;
use App\ProductVariant;
use App\RetailerProduct;
use App\RetailerProductVariant;
use App\WareHouse;
use App\WarehouseInventory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantLineItems extends Model
{
    use HasFactory;

    public function linked_product(){
        return $this->hasOne( MerchantProduct::class,'shopify_id','shopify_product_id');
    }
    public function linked_variant(){
        return $this->hasOne(MerchantVariant::class,'shopify_id','shopify_variant_id');
    }

    public function linked_real_product(){
        return $this->hasOne( \App\Models\Product::class,'shopify_id','shopify_product_id');
    }

    public function linked_admin_product(){
        return $this->hasOne( \App\Models\Product::class,'id','admin_product_id');
    }


    public function linked_real_variant(){
        return $this->hasOne(Variant::class,'shopify_id','shopify_variant_id');
    }
    public function linked_admin_variant(){
        return $this->hasOne(Variant::class,'id','admin_variant_id');
    }

    public function linked_dropship_variant(){
        return $this->hasOne(Variant::class,'id','dropship_variant_id');
    }
}
