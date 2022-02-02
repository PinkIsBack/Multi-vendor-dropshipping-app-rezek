<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\Category;
use App\Models\MerchantProductImages;
use App\Models\MerchantVariant;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductStatus;
use App\Models\Setting;
use App\Models\Variant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
//    All Products Page
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->hasRole('Admin')) {
//            $products = Product::where('status', 1)->paginate(50);

            $productQuery = Product::where('status', 1)->latest()->newQuery();
            if ($request->has('search')) {
                $productQuery->where('title', 'LIKE', '%' . $request->input('search') . '%');
            }
            $products = $productQuery->paginate(50);
            return view('products.admin_products')
                ->with([
                    'products' => $products,
                    'search' => $request->input('search'),
                ]);
        }
        if ($user->hasRole('Supplier')) {
            $productQuery = Product::where('supplier_id',Auth::user()->id)->newQuery();
            if ($request->has('search')) {
                $productQuery->where('title', 'LIKE', '%' . $request->input('search') . '%');
            }
            $products = $productQuery->paginate(50);
            return view('products.index')
                ->with([
                    'products' => $products,
                    'search' => $request->input('search'),
                ]);
        }

        if ($user->hasRole('Merchant')) {
            $productQuery = Product::where('status', 1)
                ->where('admin_status', ProductStatus::where('title', 'Approved')->first()->id)->newQuery();
            if ($request->has('search')) {
                $productQuery->where('title', 'LIKE', '%' . $request->input('search') . '%');
            }

            if ($request->has('category')) {
                $productQuery->whereHas('has_categories', function ($q) use ($request) {
                    return $q->where('title', 'LIKE', '%' . $request->input('category') . '%');
                });
            }
            $products = $productQuery->paginate(50);
            $categories = Category::all();
            return view('merchant.products.products')->with([
                'products' => $products,
                'categories' => $categories,
                'search' => $request->input('search'),
            ]);
        }
    }

//New Product Create Page
    public function create()
    {
        $categories = Category::latest()->get();
        return view('products.create')->with([
            'categories' => $categories
        ]);
    }

//Product Edit Page
    public function edit($id)
    {
        $categories = Category::latest()->get();
        $product = Product::with(['has_images', 'hasVariants.has_image', 'has_categories', 'has_subcategories'])
            ->find($id);

        $a = $product->has_categories->pluck('id')->toArray();
//        dd($a);
        return view('products.edit')->with([
            'categories' => $categories,
            'product' => $product
        ]);
    }

//Product Detail Page
    public function view(Request $request, $id)
    {
        $product = Product::find($id);
        return view('products.show')->with([
            'product' => $product
        ]);
    }

//Save new Product
    public function save(Request $request)
    {
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->compare_price = $request->compare_price;
        $product->cost = $request->cost;
        $product->type = $request->product_type;
        $product->vendor = $request->vendor;
        $product->tags = $request->tags[0];
        $product->quantity = $request->quantity;
        $product->weight = $request->weight;
        $product->sku = $request->sku;
        $product->barcode = $request->barcode;
        $product->length = $request->length;
        $product->width = $request->width;
        $product->height = $request->height;
        $product->status = $request->input('status');
        $product->attribute1 = $request->attribute1;
        $product->attribute2 = $request->attribute2;
        $product->attribute3 = $request->attribute3;
        $product->option1 = $request->option1;
        $product->option2 = $request->option2;
        $product->option3 = $request->option3;
        if ($request->variants) {
            $product->variants = $request->variants;
        }
        $product->supplier_id = Auth::user()->id;
        if (ProductStatus::first() !== null) {
            $product->admin_status = ProductStatus::first()->id;
        }
        $product->save();
        if ($request->category) {
            $product->has_categories()->attach($request->category);
        }
        if ($request->sub_cat) {
            $product->has_subcategories()->attach($request->sub_cat);
        }
        if ($request->variants) {
            $this->ProductVariants($request, $product->id);
        }
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $destinationPath = 'images/products';
                $filename = now()->format('YmdHi') . str_replace([' ', '(', ')'], '-', $image->getClientOriginalName());
                $image->move($destinationPath, $filename);
                $image = new ProductImage();
                $image->product_id = $product->id;
                $image->src = 'images/products/' . $filename;
                $image->save();
            }

        }
        $product->save();

        return redirect()->route('product.all')
            ->with('success', 'Product created successfully.');
    }

//Update Product
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $this->validate($request, [
            'sku' => 'required|unique:products,sku,' . $product->id,
            'title' => 'required|unique:products,title,' . $product->id
        ]);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->compare_price = $request->compare_price;
        $product->cost = $request->cost;
        $product->type = $request->product_type;
        $product->vendor = $request->vendor;
        $product->tags = $request->tags[0];
        $product->quantity = $request->quantity;
        $product->weight = $request->weight;
        $product->sku = $request->sku;
        $product->barcode = $request->barcode;
        $product->length = $request->length;
        $product->width = $request->width;
        $product->height = $request->height;
        $product->status = $request->input('status');
        if ($request->category) {
            $product->has_categories()->sync($request->category);
        }
        if ($request->sub_cat) {
            $product->has_subcategories()->sync($request->sub_cat);
        }
        $product->save();

//        variants Update
        if (isset($request->variant_id)) {
            for ($i = 0; $i < count($request->variant_id); $i++) {
                $variants = Variant::find($request->variant_id[$i]);
                $variants->option1 = $request->variant_option1[$i];
                $variants->option2 = $request->variant_option2[$i];
                $variants->option3 = $request->variant_option3[$i];
                $variants->title = $request->variant_option1[$i] . $request->variant_option2[$i] . $request->variant_option3[$i];
                $variants->price = $request->variant_price[$i];
                $variants->quantity = $request->variant_quantity[$i];

                if ($request->variant_cost[$i] == null) {
                    $variants->cost = null;
                } else {
                    $variants->cost = $request->variant_cost[$i];
                }

                $variants->sku = $request->variant_sku[$i];
                $variants->barcode = $request->variant_barcode[$i];
                $variants->weight = $request->variant_weight[$i];
                $variants->product_id = $id;
                $variants->save();
            }
        }
        return redirect()->back()->with('success', 'Product Updated Successfully !');
    }

//Delete Product with Variants
    public function delete($id)
    {
        $product = Product::where('id',$id)->first();
        $variants = Variant::where('product_id', $id)->get();
        foreach ($variants as $variant) {
            $variant->delete();
        }
        if($product != null){
            foreach ($product->has_images as $image) {
                $image->delete();
            }
            $product->has_categories()->detach();
            $product->has_subcategories()->detach();
            $product->delete();
        }
        return redirect()->back()->with('warning', 'Product Deleted with Variants Successfully');
    }

//    Add Variants Common Function
    public function ProductVariants($data, $id)
    {
        $product = Product::find($id);
        if (count($product->hasVariants) > 0) {
            $product->hasVariants()->delete();
        }
        for ($i = 0; $i < count($data->variant_title); $i++) {
            $options = explode('/', $data->variant_title[$i]);
            $variants = new  Variant();
            if (!empty($options[0])) {
                $variants->option1 = $options[0];
            }
            if (!empty($options[1])) {
                $variants->option2 = $options[1];
            }
            if (!empty($options[2])) {
                $variants->option3 = $options[2];
            }
            $variants->title = $data->variant_title[$i];
            $variants->price = $data->variant_price[$i];
            $variants->compare_price = $data->variant_comparePrice[$i];
            $variants->quantity = $data->variant_quantity[$i];

            if ($data->variant_cost[$i] == null) {
                $variants->cost = null;
            } else {
                $variants->cost = $data->variant_cost[$i];
            }

            $variants->sku = $data->variant_sku[$i];
            $variants->barcode = $data->variant_barcode[$i];
            $variants->product_id = $id;
            $variants->supplier_id = Auth::user()->id;
            $variants->save();
        }
    }

//Ajax Update Product Status
    public function updateProductStatus(Request $request, $id)
    {
        $product = Product::find($id);
        $product->status = $request->input('status');
        $product->save();
        if ($product->status == 1) {
            $published = 'publish';
        } else {
            $published = 'draft';
        }
    }

//Add New Images to existing Product
    public function productAddImages(Request $request, $id)
    {
        $product = Product::find($id);

        if ($product != null) {
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $destinationPath = 'images/products';
                    $filename = now()->format('YmdHi') . str_replace([' ', '(', ')'], '-', $image->getClientOriginalName());
                    $image->move($destinationPath, $filename);
                    $image = new ProductImage();
                    $image->isV = 0;
                    $image->product_id = $product->id;
                    $image->src = 'images/products/' . $filename;
                    $image->position = count($product->has_images) + $index + 1;
                    $image->save();
                }

            }
            $product->save();
            return redirect()->back()->with('success', 'Product Updated Successfully');
        }
    }

//Update Image Position in Product
    public function updateImagePosition(Request $request)
    {
        $positions = $request->positions;
        $product = $request->product;
        $images_array = [];
        foreach ($positions as $index => $position) {
            $image = ProductImage::where('product_id', $product)
                ->where('id', $position)->first();
            array_push($images_array, [
                'id' => $image->shopify_id,
                'position' => $index + 1,
            ]);
        }

        $related_product = Product::find($product);
        if ($related_product != null) {
            $data = [
                'product' => [
                    'images' => $images_array
                ]
            ];
            foreach ($positions as $index => $position) {
                $image = ProductImage::where('product_id', $product)
                    ->where('id', $position)->first();
                $image->position = $index + 1;
                $image->save();
            }
            return response()->json([
                'message' => 'success',
            ]);

        } else {
            return response()->json([
                'message' => 'error'
            ]);
        }
    }

//Delete Existing Image
    public function deleteExistingProductImage(Request $request, $id)
    {
        $product = Product::find($id);

        if ($product != null) {
            $image = ProductImage::find($request->file);
            $image->delete();
            $images_array = [];
            $product = Product::find($id);
            foreach ($product->has_images as $index => $image) {
                if ($image->isV == 0) {
                    $src = asset('$image->src');
                } else {
                    $src = asset('$image->src');
                }

                array_push($images_array, [
                    'alt' => $product->title . '_' . $index,
                    'name' => $product->title . '_' . $index,
                    'src' => $src,
                ]);
            }
            return response()->json([
                'success' => 'ok'
            ]);
        }

    }

//Add new variants to existing product
    public function addNewVariants(Request $request)
    {
        $product = Product::find($request->id);
        if ($product->varaints == 0) {
            return view('products.newVariant')->with([
                'product' => $product
            ]);
        } else {
            return redirect('/products');
        }
    }

//Save new or Update variants to existing product
    public function updateNewVariants(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product != null) {
            $product->attribute1 = $request->attribute1;
            $product->attribute2 = $request->attribute2;
            $product->attribute3 = $request->attribute3;
            $product->option1 = $request->option1;
            $product->option2 = $request->option2;
            $product->option3 = $request->option3;
            if ($request->variants) {
                $product->variants = $request->variants;
            } else {
                $product->variants = null;
            }
            $product->save();
            if ($request->variants) {
                $this->ProductVariants($request, $product->id);
            } else {
                if (count($product->hasVariants) > 0) {
                    $product->hasVariants()->delete();
                }
            }
            return redirect()->route('product.edit', $product->id)->with('success', 'Product Variants Updated Successfully');
        }
        return redirect()->route('product.edit', $product->id)->with('error', 'Something went wrong');
    }

    public function change_image($id, $image_id, Request $request)
    {
        if ($request->input('type') == 'product') {
            $variant = Variant::find($id);
            if ($variant->linked_product != null) {
                $variant->image_id = $image_id;
                $variant->save();
                return response()->json([
                    'message' => 'success'
                ]);
            } else {
                return response()->json([
                    'message' => 'false'
                ]);
            }
        } else {
            $variant = MerchantVariant::find($id);
            $shop = Auth::user();
            if ($variant->linked_product != null) {
                $variant->image = $image_id;
                $variant->save();
                return response()->json([
                    'message' => 'success'
                ]);
            } else {
                return response()->json([
                    'message' => 'false'
                ]);
            }
        }


    }

    public function update_variants(Request $request)
    {
        $product = Product::find($request->id);
//        dd($product->option1);
        if ($product->varaints !== 0) {
            return view('products.updateVariant')->with([
                'product' => $product
            ]);
        } else {
            return redirect('/products');
        }
    }
}
