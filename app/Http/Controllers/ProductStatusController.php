<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ProductStatusController extends Controller
{
    public function index(){
        $statuses = ProductStatus::all();
        return view('products.statuses')->with([
            'statuses' => $statuses
        ]);
    }
    public function save(Request $request){
        $status = new ProductStatus();
        $status->title = $request->title;
        $status->bg_color = $request->bg_color;
        $status->text_color = $request->text_color;
        $status->notes = $request->notes;
        $status->save();
        return redirect()->back()->with('success', 'New Status Added Successfully');
    }
    public function update(Request $request, $id){
        $status = ProductStatus::find($id);
        $status->title = $request->title;
        $status->bg_color = $request->bg_color;
        $status->text_color = $request->text_color;
        $status->notes = $request->notes;
        $status->save();
        return redirect()->back()->with('success', 'Status Updated Successfully');
    }
    public function delete($id){
        $status = ProductStatus::find($id);
        $status->delete();
        return redirect()->back()->with('warning', 'Status Deleted Successfully');
    }
    public function updateProductStatus($id, $status_id){
        $product = Product::find($id);
        $product->admin_status = $status_id;
        $product->save();
        return redirect()->back();
    }
}
