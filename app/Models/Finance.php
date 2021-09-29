<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function order(){
        return $this->belongsTo(\App\Models\MerchantOrder::class,'order_id');
    }

    public function supplier(){
        return $this->belongsTo(User::class,'supplier_id');
    }
    public function getCostShippingAttribute()
    {
       return    $this->order->tracking->where('supplier_id',$this->supplier_id)->first()->cost_shipping;
    }
    public function logs(){
        return $this->hasMany(FinanceLog::class,'finance_id');
    }
}
