<?php
namespace App\Helpers;

use App\Models\Setting;

class AppHelper
{
    public static function currency()
    {
        $setting = Setting::first();
        if (isset($setting)){
            if (isset($setting->currency)){
                $currency = $setting->currency;
            }else{
                $currency = '$';
            }
        }else{
            $currency = '$';
        }
        return $currency;
    }
}
