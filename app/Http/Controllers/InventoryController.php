<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function create_service()
    {
        $data = [
            'fulfillment_service' => [
                'name' => 'ZADropship',
                'callback_url' => 'https://app.minnitz.com.pk',
                "inventory_management" => true,
                "tracking_support" => false,
                "requires_shipping_method" => false,
                "format" => "json"
            ]
        ];
        $shop = Auth::user();
        if ($shop->location_id == null) {
            $resp = $shop->api()->rest('POST', '/admin/fulfillment_services.json', $data);
            if (!$resp['errors']) {
                $data = $resp['body']->container['fulfillment_service'];
                $shop->service = $data['name'];
                $shop->location_id = $data['location_id'];
                $shop->save();
            }
        }

    }

}
