<?php

namespace App\Models;

use App\ERPOrderFulfillment;
use App\Refund;
use App\ShippingRate;
use App\Zone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantOrder extends Model
{
    use HasFactory;

    public function line_items()
    {
        return $this->hasMany(MerchantLineItems::class, 'merchant_order_id');
    }

    public function has_payment()
    {
        return $this->hasOne('App\OrderTransaction', 'retailer_order_id');
    }

    public function has_store()
    {
        return $this->belongsTo(User::class, 'shop_id');
    }

    public function has_customer()
    {
        return $this->belongsTo(MerchantCustomer::class, 'customer_id');
    }

    public function fulfillments()
    {
        return $this->hasMany(OrderFulfillment::class, 'merchant_order_id');
    }

    public function logs()
    {
        return $this->hasMany(OrderLog::class, 'retailer_order_id');
    }
//    public function imported(){
//        return $this->hasOne('App\UserFileTemp','order_id');
//    }

//    public function commission()
//    {
//        return $this->hasOne('App\RetailerOrderCommission','retailer_order_id');
//    }

//    public function has_refund(){
//        return $this->hasOne(Refund::class,'order_id');
//    }

//    public function getCourierNameAttribute() {
//        if($this->shipping_address)
//        {
//            $shipping = json_decode($this->shipping_address);
//            $country = $shipping->country;
//
//            $zoneQuery = Zone::query();
//            $zoneQuery->whereHas('has_countries',function ($q) use ($country){
//                $q->where('name','LIKE','%'.$country.'%');
//            });
//            $zoneQuery = $zoneQuery->first();
//
//
//            if($zoneQuery == null)
//                return '';
//
//            if($zoneQuery->courier == null)
//                return '';
//
//            return$zoneQuery->courier->title;
//        }
//        return '';
//    }

//    public function getCourierUrlAttribute() {
//        if($this->shipping_address)
//        {
//            $shipping = json_decode($this->shipping_address);
//            $country = $shipping->country;
//
//            $zoneQuery = Zone::query();
//            $zoneQuery->whereHas('has_countries',function ($q) use ($country){
//                $q->where('name','LIKE','%'.$country.'%');
//            });
//            $zoneQuery = $zoneQuery->first();
//
//            if($zoneQuery == null)
//                return '';
//
//            if($zoneQuery->courier == null)
//                return '';
//
//            return$zoneQuery->courier->url;
//        }
//        return '';
//    }

//    public function getCourierIdAttribute() {
//        if($this->shipping_address)
//        {
//            $shipping = json_decode($this->shipping_address);
//            $country = $shipping->country;
//
//            $zoneQuery = Zone::query();
//            $zoneQuery->whereHas('has_countries',function ($q) use ($country){
//                $q->where('name','LIKE','%'.$country.'%');
//            });
//            $zoneQuery = $zoneQuery->first();
//
//            if($zoneQuery == null)
//                return '';
//
//            if($zoneQuery->courier == null)
//                return '';
//
//            return$zoneQuery->courier->id;
//        }
//        return '';
//    }

//    public function getTotalCostAttribute() {
//        $cost_to_pay = 0;
//        foreach ($this->line_items()->where('fulfilled_by', '!=', 'store')->get() as $index => $item) {
//            $cost_to_pay = $cost_to_pay + $item->cost * $item->quantity;
//        }
//        return $cost_to_pay;
//    }

//    public function getShippingRateAttribute() {
//
//        $shipping_address = json_decode($this->shipping_address);
//        $total_shipping = 0;
//
//        if(isset($shipping_address)){
//            $country = $shipping_address->country;
//            foreach ($this->line_items()->where('fulfilled_by', '!=', 'store')->get() as $index => $v){
//                if($v->linked_product != null && $v->linked_product->linked_product){
//                    $weight = $v->linked_product->linked_product->weight *  $v->quantity;
//                    if($v->linked_product->linked_product != null) {
//                        $zoneQuery = Zone::where('warehouse_id', $v->selected_warehouse)->newQuery();
//                        $zoneQuery->whereHas('has_countries',function ($q) use ($country){
//                            $q->where('name','LIKE','%'.$country.'%');
//                        });
//                        $zoneQuery = $zoneQuery->pluck('id')->toArray();
//
//                        $shipping_rates = ShippingRate::whereIn('zone_id',$zoneQuery)->newQuery();
//                        $shipping_rates =  $shipping_rates->first();
//                        if($shipping_rates != null){
//
//                            if($shipping_rates->type == 'flat'){
//                                $total_shipping += $shipping_rates->shipping_price;
//                            }
//                            else{
//                                if($shipping_rates->min > 0){
//                                    $ratio = $weight/$shipping_rates->min;
//                                    $total_shipping +=  $shipping_rates->shipping_price*$ratio;
//                                }
//                                else{
//                                    $total_shipping += 0;
//                                }
//                            }
//
//                        }
//                        else{
//                            $total_shipping += 0;
//                        }
//                    }
//                }
//            }
//
//            return number_format($total_shipping, 2);
//        }
//    }
//    public function isShippable() {
//        $shipping_address = json_decode($this->shipping_address);
//
//        if(isset($shipping_address)){
//
//            $country = $shipping_address->country;
//
//            $zoneQuery = Zone::where('warehouse_id', 3)->newQuery();
//            $zoneQuery->whereHas('has_countries',function ($q) use ($country){
//                $q->where('name','LIKE','%'.$country.'%');
//            });
//            $zoneQuery = $zoneQuery->pluck('id')->toArray();
//
//            $shipping_rates = ShippingRate::whereIn('zone_id',$zoneQuery)->newQuery();
//            $shipping_rates =  $shipping_rates->first();
//            if($shipping_rates != null){
//                return true;
//            }
//            else{
//                return false;
//            }
//        }
//
//        return false;
//    }
}
