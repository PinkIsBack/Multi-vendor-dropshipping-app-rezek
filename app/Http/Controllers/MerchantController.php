<?php

namespace App\Http\Controllers;

use App\Models\MerchantProduct;
use App\Models\MerchantProductImages;
use App\Models\MerchantVariant;
use App\Models\Product;
use App\Models\ProductStatus;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MerchantController extends Controller
{
    public function myProducts(Request $request)
    {
        $shop = Auth::user();
        $productQuery = MerchantProduct::with(['has_images', 'hasVariants.has_image', 'linked_product'])
            ->where('toShopify', 1)->where('shop_id', $shop->id)->newQuery();
        if ($request->has('search')) {
            $productQuery->where('title', 'LIKE', '%' . $request->input('search') . '%');
        }
        $products = $productQuery->orderBy('id','desc')->paginate(15);
        return view('merchant.products.my_products')->with([
            'products' => $products,
            'shop' => $shop,
            'search' => $request->input('search'),
        ]);
    }
    public function myProductEdit($id){
        $product = MerchantProduct::find($id);
        $shop= Auth::user();
        return view('merchant.products.edit_my_product')->with([
            'product' => $product,
            'shop' => $shop
        ]);
    }
    public function myProductDetail($id){

        $product = MerchantProduct::find($id);
        return view('merchant.products.detail')->with([
            'product' => $product
        ]);
    }

//    Import List Products
    public function import_list(Request $request)
    {
        $shop = Auth::user();
        $productQuery = MerchantProduct::with(['has_images', 'hasVariants.has_image', 'linked_product'])
            ->where('toShopify', 0)->where('shop_id', $shop->id)->newQuery();
        if ($request->has('search')) {
            $productQuery->where('title', 'LIKE', '%' . $request->input('search') . '%');
        }
        $products = $productQuery->orderBy('id','DESC')->paginate(15);
        return view('merchant.products.import_list')->with([
            'products' => $products,
            'shop' => $shop,
            'search' => $request->input('search'),
        ]);
    }

//    Import List Update
    public function update(Request $request, $id)
    {
        $product = MerchantProduct::find($id);
        $shop = Auth::user();
        if ($product != null) {
            if ($request->has('request_type')) {

                /*Single Variant Update Shopify and Database*/
                if ($request->input('request_type') == 'single-variant-update') {
                    $variant = MerchantVariant::find($request->variant_id);
                    $variant->price = $request->input('price');
                    $variant->barcode = $request->input('barcode');
                    $variant->product_id = $id;
                    $variant->save();

                    if ($product->toShopify == 1) {
                        if ($variant->is_dropship_variant == 1)
                            $option1 = $variant->title;
                        else
                            $option1 = $variant->option1;

                        $productdata = [
                            "variant" => [
                                'title' => $variant->title,
                                'option1' => $option1,
                                'option2' => $variant->option2,
                                'option3' => $variant->option3,
                                'grams' => $product->weight * 1000,
                                'weight' => $product->weight,
                                'weight_unit' => 'kg',
                                'barcode' => $variant->barcode,
                                'price' => $variant->price,
                                'cost' => $variant->cost,
                            ]
                        ];
                        $resp = $shop->api()->rest('PUT', '/admin/products/' . $product->shopify_id . '/variants/' . $variant->shopify_id . '.json', $productdata);
                    }
                }
                /*Default Variant Update*/
                if ($request->input('request_type') == 'default-variant-update') {

                    $product->price = $request->input('price');
                    $product->quantity = $request->input('quantity');
                    $product->barcode = $request->input('barcode');
                    $product->save();

                    if ($product->toShopify == 1) {
                        $response = $shop->api()->rest('GET', '/admin/products/' . $product->shopify_id . '.json');
                        $response = json_decode(json_encode($response));
                        if (!$response->errors) {
                            $shopifyVariants = $response->body->product->variants;
                            $variant_id = $shopifyVariants[0]->id;
                            $i = [
                                'variant' => [
                                    'price' => $product->price,
                                    'grams' => $product->weight * 1000,
                                    'weight' => $product->weight,
                                    'weight_unit' => 'kg',
                                    'barcode' => $product->barcode,

                                ]
                            ];
                          $data =  $shop->api()->rest('PUT', '/admin/variants/' . $variant_id . '.json', $i);
                        }
                    }
                }


                /*Product Basic Update Shopify and Database*/
                if ($request->input('request_type') == 'basic-info') {
                    $product->title = $request->title;
                    $product->type = $request->type;
                    $product->vendor = $request->vendor;
                    $product->tags = $request->tags;
                    $product->save();
                    if ($product->toShopify == 1) {
                        $productdata = [
                            "product" => [
                                "title" => $request->title,
                                "vendor" => $request->vendor,
                                "product_type" => $request->type,
                                "tags" => $request->tags,
                            ]
                        ];
                        $resp = $shop->api()->rest('PUT', '/admin/products/' . $product->shopify_id . '.json', $productdata);
                    }
                }

                if ($request->input('request_type') == 'description') {
                    $product->description = $request->description;
                    $product->save();
                    if ($product->toShopify == 1) {
                        $productdata = [
                            "product" => [
                                "body_html" => $request->description,
                            ]
                        ];
                        $resp = $shop->api()->rest('PUT', '/admin/api/2019-10/products/' . $product->shopify_id . '.json', $productdata);
                    }
                }


                if ($request->input('request_type') == 'variant-image-update') {
                    $variant = MerchantVariant::find($request->variant_id);
                    if ($request->hasFile('varaint_src')) {
                        $image = $request->file('varaint_src');
                        $destinationPath = 'images/variants/';
                        $filename = now()->format('YmdHi') . str_replace([' ', '(', ')'], '-', $image->getClientOriginalName());
                        $image->move($destinationPath, $filename);
                        $image = new MerchantProductImages();
                        $image->isV = 1;
                        $image->product_id = $product->id;
                        $image->src = $filename;
                        $image->save();
                        $variant->image = $image->id;
                        $variant->save();
                        if ($product->toShopify == 1) {
                            $imageData = [
                                'image' => [
                                    'src' => asset($image->src),
                                    'variant_ids' => [$variant->shopify_id]
                                ]
                            ];
                            $imageResponse = $shop->api()->rest('POST', '/admin/products/' . $product->shopify_id . '/images.json', $imageData);
                            $image->shopify_id = $imageResponse['body']->container['image']['id'];
                            $image->save();

                        }
                    }
                    return redirect()->back();

                }

                if ($request->input('request_type') == 'existing-product-image-delete') {
                    $image = MerchantProductImages::find($request->input('file'));
                    if ($product->toShopify == 1) {
                        $shop->api()->rest('DELETE', '/admin/products/' . $product->shopify_id . '/images/' . $image->shopify_id . '.json');
                    }
                    $image->delete();
                    return response()->json([
                        'success' => 'ok'
                    ]);
                }

                if ($request->input('request_type') == 'existing-product-image-add') {
                    if ($request->hasFile('images')) {
                        foreach ($request->file('images') as $image) {
                            $destinationPath = 'images/products';
                            $filename = now()->format('YmdHi') . str_replace(' ', '-', $image->getClientOriginalName());
                            $image->move($destinationPath, $filename);
                            $image = new MerchantProductImages();
                            $image->isV = 0;
                            $image->product_id = $product->id;
                            $image->src = 'images/products/' . $filename;
                            $image->save();
                            if ($product->toShopify == 1) {
                                $imageData = [
                                    'image' => [
                                        'src' => asset($image->src),
                                    ]
                                ];
                                $imageResponse = $shop->api()->rest('POST', '/admin/products/' . $product->shopify_id . '/images.json', $imageData);
                                $image->shopify_id = $imageResponse['body']->container['image']['id'];
                                $image->save();
                            }
                        }
                    }
                    $product->save();
                }

            }
        }
    }

//    Import List Variant Update
    public function updateProductVariantPrice(Request $request, $id)
    {
        $product = MerchantProduct::find($id);
        $variant = MerchantVariant::find($request->input('variant_id'));
        $shop = Auth::user();

        if ($product != null && $variant != null) {
            $variant->price = $request->input('price');
            $variant->save();

            if ($product->toShopify == 1) {

                $productdata = [
                    "variant" => [
                        'price' => $variant->price,
                    ]
                ];

                $resp = $shop->api()->rest('PUT', '/admin/products/' . $product->shopify_id . '/variants/' . $variant->shopify_id . '.json', $productdata);

            }

            return response()->json(['status' => 'success']);
        }
    }

//    Delete Import List Product
    public function delete($id)
    {
        $product = MerchantProduct::find($id);
        $shop = Auth::user();
        if ($product->toShopify == 1 && $product->import_from_shopify == 0 && $product->is_dropship_product == null) {
            $shop->api()->rest('DELETE', '/admin/products/' . $product->shopify_id . '.json');
        }
        $variants = MerchantVariant::where('product_id', $id)->get();
        foreach ($product->hasVariants as $variant) {
            $variant->delete();
        }
        foreach ($product->has_images as $image) {
            $image->delete();
        }
        $product->delete();
        return redirect()->back()->with('success', 'Product Deleted with Variants Successfully');
    }

//    Copy Product to Import List
    public function import_to_merchant($id)
    {
        $product = Product::find($id);
        $shop = Auth::user();
        if ($product != null) {
            if (MerchantProduct::where('linked_product_id', $product->id)->where('shop_id', $shop->id)->exists()) {
                return redirect()->back()->with([
                    'info' => 'This Product Already Imported'
                ]);
            } else {
                /*Product Copy*/
                $merchantProduct = new MerchantProduct();
                $merchantProduct->linked_product_id = $product->id;

                $merchantProduct->length = $product->length;
                $merchantProduct->width = $product->width;
                $merchantProduct->height = $product->height;
                $merchantProduct->status = $product->status;
                $merchantProduct->attribute1 = $product->attribute1;
                $merchantProduct->attribute2 = $product->attribute2;
                $merchantProduct->attribute3 = $product->attribute3;
                $merchantProduct->option1 = $product->option1;
                $merchantProduct->option2 = $product->option2;
                $merchantProduct->option3 = $product->option3;
                $merchantProduct->variants = $product->variants;
                $merchantProduct->title = $product->title;
                $merchantProduct->description = $product->description;
                $merchantProduct->type = $product->type;
                $tags = $product->tags;
                if (count($product->has_categories) > 0) {
                    $categories = implode(',', $product->has_categories->pluck('title')->toArray());
                    $tags = $tags . ',' . $categories;
                }
                if (count($product->has_subcategories) > 0) {
                    $subcategories = implode(',', $product->has_subcategories->pluck('title')->toArray());
                    $tags = $tags . ',' . $subcategories;
                }
                $merchantProduct->tags = $tags;
                $merchantProduct->vendor = $product->vendor;
                $merchantProduct->price = $product->c_price;
                $merchantProduct->cost = $product->c_price;
                $merchantProduct->margin = Setting::first()->margin;
                $merchantProduct->supplier_price = $product->price;
                $merchantProduct->supplier_id = $product->supplier_id;
                $merchantProduct->quantity = $product->quantity;
                $merchantProduct->weight = $product->weight;
                $merchantProduct->sku = $product->sku;
                $merchantProduct->barcode = $product->barcode;
                $merchantProduct->variants = $product->variants;
                $merchantProduct->status = 1;
                $merchantProduct->fulfilled_by = 'ZADropship';
                $merchantProduct->toShopify = 0;
                $merchantProduct->shop_id = $shop->id;
                $merchantProduct->save();
                /*Product Images Copy*/
                if (count($product->has_images) > 0) {
                    foreach ($product->has_images()->orderBy('position')->get() as $index => $image) {
                        $merchantProductImage = new MerchantProductImages();
                        $merchantProductImage->isV = $image->isV;
                        $merchantProductImage->product_id = $merchantProduct->id;
                        $merchantProductImage->shop_id = $shop->id;
                        $merchantProductImage->src = $image->src;
                        $merchantProductImage->position = $index + 1;
                        $merchantProductImage->save();
                    }
                }
                /*Product Variants Copy*/
                if ($merchantProduct->variants != null) {
                    if (count($product->hasVariants) > 0) {
                        foreach ($product->hasVariants as $variant) {
                            $merchantProductVariant = new MerchantVariant();
                            $merchantProductVariant->title = $variant->title;
                            $merchantProductVariant->option1 = $variant->option1;
                            $merchantProductVariant->option2 = $variant->option2;
                            $merchantProductVariant->option3 = $variant->option3;
                            $merchantProductVariant->price = $variant->c_price;
                            $merchantProductVariant->cost = $variant->c_price;
                            $merchantProductVariant->supplier_price = $variant->price;
                            $merchantProductVariant->margin = Setting::first()->margin;
                            $merchantProductVariant->supplier_id = $variant->supplier_id;
                            $merchantProductVariant->quantity = $variant->quantity;
                            $merchantProductVariant->sku = $variant->sku;
                            $merchantProductVariant->barcode = $variant->barcode;

                            $merchantProductVariant->linked_variant_id = $variant->id;
                            $merchantProductVariant->product_id = $merchantProduct->id;
                            $merchantProductVariant->shop_id = $merchantProduct->shop_id;

                            if ($variant->has_image != null) {
                                $image_linked = $merchantProduct->has_images()->where('src', $variant->has_image->src)->first();
                                $merchantProductVariant->image = $image_linked->id;
                            }

                            $merchantProductVariant->save();
                        }
                    }
                }
                $product->import_count = $product->import_count + 1;
                $product->save();

                return redirect()->back()->with([
                    'success' => 'Product Added to Import List Successfully'
                ]);

            }
        } else {
            return redirect()->back()->with([
                'error' => 'This Product Cannot Be Imported'
            ]);
        }
    }

//    Push Product to Shopify
    public function import_to_shopify($id)
    {
        $product = MerchantProduct::find($id);
//        if ($product != null && $product->toShopify != 1) {
        if ($product != null) {
            $variants_array = [];
            $options_array = [];
            $images_array = [];
            //converting variants into shopify api format
            $variants_array = $this->variants_template_array($product, $variants_array);
            /*Product Options*/
            $options_array = $this->options_template_array($product, $options_array);
            /*Product Images*/
            foreach ($product->has_images as $index => $image) {
                if ($image->isV == 0) {
                    $src = asset($image->src);
                } else {
                    $src = asset($image->src);
                }
                array_push($images_array, [
                    'alt' => $product->title . '_' . $index,
                    'position' => $index + 1,
                    'src' => $src,
                ]);
            }
            $shop = Auth::user();
            $tags = $product->tags;
            if ($product->status == 1) {
                $published = true;
            } else {
                $published = false;
            }

            if ($product->type != null) {
                $product_type = $product->type;
            } else {
                $product_type = 'ZADROPSHIP';
            }

            $productdata = [
                "product" => [
                    "title" => $product->title,
                    "body_html" => $product->description,
                    "vendor" => $product->vendor,
                    "tags" => $tags,
                    "product_type" => $product_type,
                    "variants" => $variants_array,
                    "options" => $options_array,
                    "images" => $images_array,
                    "published" => $published
                ]
            ];
            $response = $shop->api()->rest('POST', '/admin/products.json', $productdata);
            if ($response['errors']) {
                return redirect()->back()->with('error', 'Product Cant be Imported To store');
            }
            $product_shopify_id = $response['body']->container['product']['id'];
            $product->shopify_id = $product_shopify_id;
            $price = $product->price;
            $product->toShopify = 1;
            $product->save();

            $shopifyImages = $response['body']->container['product']['images'];
            $shopifyVariants = $response['body']->container['product']['variants'];
            if (count($product->hasVariants) == 0) {
                $variant_id = $shopifyVariants[0]['id'];
                $product->inventory_item_id = $shopifyVariants[0]['inventory_item_id'];
                $i = [
                    'variant' => [
                        'price' => $price,
                        'sku' => $product->sku,
                        'grams' => $product->weight * 1000,
                        'weight' => $product->weight,
                        'weight_unit' => 'kg',
                        'barcode' => $product->barcode,
                    ]
                ];
                $shop->api()->rest('PUT', '/admin/variants/' . $variant_id . '.json', $i);

                $data = [
                    "inventory_item" => [
                        'id' => $product->inventory_item_id,
                        "tracked" => true
                    ]

                ];
                $resp = $shop->api()->rest('PUT', '/admin/inventory_items/' . $product->inventory_item_id . '.json', $data);
                /*Connect to ZADropship*/
                $data = [
                    'location_id' => $shop->location_id,
                    'inventory_item_id' => $product->inventory_item_id,
                    'relocate_if_necessary' => true
                ];
                $res = $shop->api()->rest('POST', '/admin/inventory_levels/connect.json', $data);
                /*Set Quantity*/
                $data = [
                    'location_id' => $shop->location_id,
                    'inventory_item_id' => $product->inventory_item_id,
                    'available' => $product->quantity,

                ];
                $res = $shop->api()->rest('POST', '/admin/inventory_levels/set.json', $data);
            } else {
                foreach ($product->hasVariants as $index => $v) {
                    $v->shopify_id = $shopifyVariants[$index]['id'];
                    $v->inventory_item_id = $shopifyVariants[$index]['inventory_item_id'];
                    $v->save();
                    $data = [
                        "inventory_item" => [
                            'id' => $v->inventory_item_id,
                            "tracked" => true
                        ]

                    ];
                    $resp = $shop->api()->rest('PUT', '/admin/inventory_items/' . $v->inventory_item_id . '.json', $data);
                    /*Connect to ZADropship*/
                    $data = [
                        'location_id' => $shop->location_id,
                        'inventory_item_id' => $v->inventory_item_id,
                        'relocate_if_necessary' => true
                    ];
                    $res = $shop->api()->rest('POST', '/admin/inventory_levels/connect.json', $data);
                    /*Set Quantity*/
                    $data = [
                        'location_id' => $shop->location_id,
                        'inventory_item_id' => $v->inventory_item_id,
                        'available' => $v->quantity,
                    ];
                    $res = $shop->api()->rest('POST', '/admin/inventory_levels/set.json', $data);
                }
            }
            if (count($shopifyImages) == count($product->has_images)) {
                foreach ($product->has_images as $index => $image) {
                    $image->shopify_id = $shopifyImages[$index]['id'];
                    $image->save();
                }
            }

            foreach ($product->hasVariants as $index => $v) {
                if ($v->has_image != null) {
                    $i = [
                        'image' => [
                            'id' => $v->has_image->shopify_id,
                            'variant_ids' => [$v->shopify_id]
                        ]
                    ];
                    $imagesResponse = $shop->api()->rest('PUT', '/admin/products/' . $product_shopify_id . '/images/' . $v->has_image->shopify_id . '.json', $i);
                }
            }
            return redirect()->back()->with('success', 'Product Push to Store Successfully!');
        } else {
            echo 'imported already';
        }
    }

    public function variants_template_array($product)
    {
        $variants_array = [];
        foreach ($product->hasVariants as $index => $varaint) {
            array_push($variants_array, [
                'title' => $varaint->title,
                'sku' => $varaint->sku,
                'option1' => $varaint->option1,
                'option2' => $varaint->option2,
                'option3' => $varaint->option3,
                'inventory_quantity' => $varaint->quantity,
                'grams' => $product->weight * 1000,
                'weight' => $product->weight,
                'weight_unit' => 'kg',
                'barcode' => $varaint->barcode,
                'price' => $varaint->price,
                'cost' => $varaint->cost,
            ]);
        }
        return $variants_array;
    }

    public function options_template_array($product)
    {
        $options_array = [];
        if (isset($product->option1)) {
            $temp = [];
            foreach (explode(',', $product->option1) as $a) {
                array_push($temp, $a);
            }
            array_push($options_array, [
                'name' => 'Option1',
                'position' => '1',
                'values' => json_encode($temp),
            ]);
        }
        if (isset($product->option2)) {
            $temp = [];
            foreach (explode(',', $product->option2) as $a) {
                array_push($temp, $a);
            }
            array_push($options_array, [
                'name' => 'Option2',
                'position' => '2',
                'values' => json_encode($temp),
            ]);
        }
        if (isset($product->option3)) {
            $temp = [];
            foreach (explode(',', $product->option3) as $a) {
                array_push($temp, $a);
            }
            array_push($options_array, [
                'name' => 'Option3',
                'position' => '3',
                'values' => json_encode($temp),
            ]);
        }
        return $options_array;
    }
}
