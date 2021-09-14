<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\ShippingRoute;
use App\Models\State;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function index(){
        $states = State::all();
        return view('shipping.areas')->with([
            'states' => $states
        ]);
    }
    public function save(Request $request){
       if ($request->type == 'state'){
           $state = State::where('title', 'LIKE', '%' . $request->title . '%')->first();
           if ($state == null){
               $state = new State();
           }
           $state->title = $request->title;
           $state->save();
           return redirect()->back()->with('success', 'New State Added Successfully');
       }

        if ($request->type == 'city') {
            foreach ($request->city as $item){
                $city = City::where('title', 'LIKE', '%' . $item . '%')->first();
                if ($city == null){
                    $city = new City();
                }
                $city->title = $item;
                $city->state_id = $request->state;
                $city->save();
            }

            return redirect()->back()->with('success', 'New City Added to '.State::find($request->state)->title.' State Successfully');
        }
    }
    public function update(Request $request, $id){
        if ($request->type == 'state'){
            $state = State::find($id);
            $state->title = $request->title;
            $state->save();
        }
        if ($request->type == 'city'){
            $city = City::find($id);
            $city->title = $request->title;
            $city->save();
        }
        return redirect()->back()->with('success', 'Updated Successfully');
    }
    public function delete(Request $request, $id){
        if ($request->type == 'state'){
            $state = State::find($id);
            if (count($state->has_city) > 0) {
                City::where('state_id', $state->id)->each(function ($item, $key) {
                    $item->delete();
                });
            }
            $state->delete();
            return redirect()->back()->with('warning', 'State Deleted with Cities Successfully');
        }
        if ($request->type == 'city'){
            $city = City::find($id);
            $city->delete();
            return redirect()->back()->with('warning', 'City Deleted Successfully');
        }
    }
    public function route_list(){
        $routes = ShippingRoute::latest()->get();
        $cities = City::all();
        return view('shipping.route')->with([
            'cities' => $cities,
            'routes' => $routes
        ]);
    }
    public function routeSave(Request $request){
        $route = new ShippingRoute();
        $route->price = $request->price;
        $route->processing_time = $request->processing_time;
        $route->shipping_time = $request->shipping_time;
        $route->origin_city_id = $request->orgin;
        $route->destination_city_id = $request->destination;
        $route->save();
        return redirect()->back()->with('success', 'Shipping Route Added Successfully');
    }
    public function routeUpdate(Request $request, $id){
        $route = ShippingRoute::find($id);
        $route->price = $request->price;
        $route->processing_time = $request->processing_time;
        $route->shipping_time = $request->shipping_time;
        $route->origin_city_id = $request->orgin;
        $route->destination_city_id = $request->destination;
        $route->save();
        return redirect()->back()->with('success', 'Shipping Route Updated Successfully');
    }
    public function routeDelete($id){
        $route = ShippingRoute::find($id);
        $route->delete();
        return redirect()->back()->with('warning', 'Shipping Route Removed Successfully');
    }
}
