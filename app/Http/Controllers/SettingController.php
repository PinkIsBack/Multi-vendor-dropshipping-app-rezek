<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $setting = Setting::first();
        return view('settings')->with([
            'setting' => $setting
        ]);
    }
    public function save(Request $request){
        $setting = Setting::first();
        if ($setting == null){
            $setting = new Setting();
        }
        $setting->margin = $request->margin;
        $setting->currency_label = $request->currency_label;
        $setting->currency = $request->currency_sign;
        $setting->save();
        return redirect()->back()->with('success', '');
    }
}
