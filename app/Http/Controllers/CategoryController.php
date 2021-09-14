<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->get();
        return view('category.index')->with([
            'categories' => $categories
        ]);
    }
    public function create(){
        return view('category.create');
    }
    public function save(Request $request){

        if ($request->hasFile('category_img')) {
            $file = $request->file('category_img');
            $file_name = $file->getClientOriginalName();
            $file->move(public_path() . '/images/category/', $file_name);
            $category_img = '/images/category/'. $file_name;
        }
        $category = new Category();
        $category->title = $request->title;
        $category->slug = $request->slug;
        if (isset($category_img)){
            $category->img = $category_img;
        }
        $category->save();
        if (isset($request->sub_category_title)) {
            foreach ($request->sub_category_title as $i => $sub_title) {
                if ($request->hasFile('sub_category_img[' . $i . ']')) {
                    $file = $request->file('sub_category_img[' . $i . ']');
                    $file_name = $file->getClientOriginalName();
                    $file->move(public_path() . '/images/category/', $file_name);
                    $sub_category_img = '/images/category/' . $file_name;
                }
                $subCategory = new SubCategory();
                $subCategory->title = $sub_title;
                $subCategory->slug = $request->sub_category_slug[$i];
                if (isset($sub_category_img)) {
                    $subCategory->img = $sub_category_img;
                }
                $subCategory->category_id = $category->id;
                $subCategory->save();
            }
        }
        return redirect()->route('category.all')->with('success', 'Category Created Successfully');
    }
    public function update(Request $request, $id){
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $file_name = $file->getClientOriginalName();
            $file->move(public_path() . '/images/category/', $file_name);
            $img = '/images/category/'. $file_name;
        }
        if ($request->type == 'newSubCategory'){
            $data = new SubCategory();
            $data->category_id = $id;
            $message = 'SubCategory Added Successfully';
        }
        if ($request->type == 'updateCategory'){
            $data = Category::find($id);
            $message = 'Category Updated Successfully';
        }
        if ($request->type == 'updateSubCategory'){
            $data = SubCategory::find($id);
            $message = 'SubCategory Updated Successfully';
        }
        $data->title = $request->title;
        $data->slug = $request->slug;
        if (isset($img)) {
            $data->img = $img;
        }
        $data->save();
        return redirect()->back()->with('success', $message);
    }
    public function delete(Request $request, $id){
//        dd($request->type);
        if ($request->type == 'category'){
            $category = Category::find($id);
            if (count($category->has_subCategory) > 0) {
                SubCategory::where('category_id', $category->id)->each(function ($item, $key) {
                    $item->delete();
                });
            }
            $category->delete();
        }
        if ($request->type == 'subcategory'){
            SubCategory::find($id)->delete();
        }
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
