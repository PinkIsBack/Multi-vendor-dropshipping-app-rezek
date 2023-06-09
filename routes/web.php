<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\SupplierOrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductStatusController;
use App\Models\MerchantProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [HomeController::class,'index'])->middleware(['auth.shopify'])->name('home');

//This will redirect user to login page.
Route::get('/app/login', function () {
    if (Auth::user()) {
        return redirect()->route('home');
    }
    return view('shop_login');
    return view('login');
})->name('login');

Route::group(['middleware' => ['auth.shopify', 'billable']], function () {
    Route::get('/testoment',function (){
        return redirect()->route('store.order.detail',668)->with('success','Order paid successfully');
    });
    Route::get('/products', [ProductController::class, 'index'])->name('product.all');
    Route::get('/merchant/product/{id}/import', [MerchantController::class, 'import_to_merchant'])->name('import.product.merchant');
    Route::get('/import/list', [MerchantController::class, 'import_list'])->name('import.product.list');
    Route::get('/import/list/product/{id}/delete', [MerchantController::class, 'delete'])->name('import.product.delete');
    Route::post('/import/list/product/{id}/update', [MerchantController::class, 'update'])->name('import.product.update');
    Route::get('/import/list/product/{id}/update/variant/price', [MerchantController::class, 'updateProductVariantPrice'])->name('import.product.variant.price.update');
    //Shopify Store Interaction
    Route::any('/import/{id}/shopify', [MerchantController::class, 'import_to_shopify'])->name('import.product.shopify');
    // My Products
    Route::any('/myproducts', [MerchantController::class, 'myProducts'])->name('my.product.list');
    Route::any('/myproducts/{id}/detail', [MerchantController::class, 'myProductDetail'])->name('my.product.detail');
    Route::any('/myproducts/{id}/edit', [MerchantController::class, 'myProductEdit'])->name('my.product.edit');
    // Sync Shopify Orders
    Route::get('/shopify/orders', [OrderController::class,'getOrders'])->name('store.sync.orders');
    Route::get('/orders', [OrderController::class, 'index'])->name('store.orders');
    Route::get('/order/{id}/detail', [OrderController::class, 'detail'])->name('store.order.detail');
    Route::get('/payfast-pay/{id}/success',[OrderController::class,'payfast_paid_success'])->name('store.payfast.pay.success');
    Route::get('/finance',[OrderController::class,'financeIndex'])->name('store.finance.index');


});
Route::get('test',function (){
  $shop =  auth()->user();
  $data = [

  ];
//    dd($shop->api()->rest('POST','/admin/webhooks.json',[
//        'webhook' => [
//            'topic' => 'orders/create',
//            'address' => 'https://phpstack-670512-2197626.cloudwaysapps.com/webhook/orders-create',
//            "format"=> "json"
//        ]
//    ]));
});
Auth::routes();
Route::group(['middleware' => ['auth']], function () {
//    Refund request

    Route::get('/refund-request',[OrderController::class,'refund_request'])->name('store.order.refund.request');


    Route::get('/categories', [CategoryController::class, 'index'])->name('category.all');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/categories/save', [CategoryController::class, 'save'])->name('category.save');
    Route::any('/categories/{id}/update', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/categories/{id}/delete', [CategoryController::class, 'delete'])->name('category.delete');
//    Product Crud
    Route::get('/products', [ProductController::class, 'index'])->name('product.all');
    Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/products/save', [ProductController::class, 'save'])->name('product.save');
    Route::get('/products/{id}/detail', [ProductController::class, 'view'])->name('product.detail');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::any('/products/{id}/update', [ProductController::class, 'update'])->name('product.update');
    Route::any('/products/{id}/change/status', [ProductController::class, 'updateProductStatus'])->name('product.change.status');
    Route::any('/products/{id}/add/images', [ProductController::class, 'productAddImages'])->name('product.add.images');
    Route::get('/products/{id}/images/position/update', [ProductController::class, 'updateImagePosition'])->name('product.update_image_position');
    Route::any('/products/{id}/delete/existing/image', [ProductController::class, 'deleteExistingProductImage'])->name('product.delete.existing.image');
    Route::get('/products/{id}/varaints/new', [ProductController::class, 'addNewVariants'])->name('product.new_variants');
    Route::any('/products/{id}/update/variants/new', [ProductController::class, 'updateNewVariants'])->name('product.update.new_variants');
    Route::get('/products/{id}/delete', [ProductController::class, 'delete'])->name('product.delete');
    Route::get('/variant/{id}/change/image/{image_id}', [ProductController::class, 'change_image'])->name('change_image');
    Route::get('/products/{id}/varaints/update', [ProductController::class, 'update_variants'])->name('product.existing_product_update_variants');

    Route::any('/products/{id}/status/{status_id}/change', [ProductStatusController::class, 'updateProductStatus'])->name('product.admin.change.status');

    //   Product Status Crud
    Route::get('/products/status', [ProductStatusController::class, 'index'])->name('productstatus.all');
    Route::any('/products/status/save', [ProductStatusController::class, 'save'])->name('productstatus.save');
    Route::any('/products/status/{id}/update', [ProductStatusController::class, 'update'])->name('productstatus.update');
    Route::any('/products/status/{id}/delete', [ProductStatusController::class, 'delete'])->name('productstatus.delete');
//Settings
    Route::get('/settings', [\App\Http\Controllers\SettingController::class, 'index'])->name('setting');
    Route::any('/settings/save', [\App\Http\Controllers\SettingController::class, 'save'])->name('setting.save');
//  Shipping State & City Crud
    Route::get('/shipping/area', [\App\Http\Controllers\ShippingController::class, 'index'])->name('shipping.areas');
    Route::any('/shipping/area/save', [\App\Http\Controllers\ShippingController::class, 'save'])->name('shipping.areas.save');
    Route::any('/shipping/area/{id}/update', [\App\Http\Controllers\ShippingController::class, 'update'])->name('shipping.areas.update');
    Route::any('/shipping/area/{id}/delete', [\App\Http\Controllers\ShippingController::class, 'delete'])->name('shipping.areas.delete');
//    Shipping Route and Pricing
    Route::get('/shipping/route', [\App\Http\Controllers\ShippingController::class, 'route_list'])->name('shipping.routes');
    Route::any('/shipping/route/save', [\App\Http\Controllers\ShippingController::class, 'routeSave'])->name('shipping.routes.save');
    Route::any('/shipping/route/{id}/update', [\App\Http\Controllers\ShippingController::class, 'routeUpdate'])->name('shipping.routes.update');
    Route::any('/shipping/route/{id}/delete', [\App\Http\Controllers\ShippingController::class, 'routeDelete'])->name('shipping.routes.delete');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::get('/merchant', [UserController::class, 'merchant'])->name('merchant.all');
    Route::get('/supplier', [UserController::class, 'supplier'])->name('supplier.all');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::any('/profile/{id}/update', [UserController::class, 'profileUpdate'])->name('user.profile.update');
//    Order for Admin
    Route::get('admin/orders/all',[AdminOrderController::class,'index'])->name('orders.all');
    Route::post('admin/ordered/store',[AdminOrderController::class,'ordered_store'])->name('ordered.store');
    Route::get('/admin/order/{id}/detail', [AdminOrderController::class, 'detail'])->name('admin.order.detail');
    Route::get('admin/payfast-pay/{id}/success',[AdminOrderController::class,'payfast_paid_success'])->name('admin.payfast.pay.success');
//    Order for supplier
    Route::get('supplier/orders/all',[SupplierOrderController::class,'index'])->name('supplier.orders.all');
    Route::get('supplier/order/{id}/detail', [SupplierOrderController::class, 'detail'])->name('supplier.order.detail');
    Route::get('supplier/order/{id}/fulfillment',[SupplierOrderController::class,'fulfill_order'])->name('supplier.order.fulfillment');
    Route::post('supplier/order/fulfillment/{id}/complete',[SupplierOrderController::class,'fulfillment_order'])->name('supplier.order.fulfillment.process');
    Route::post('supplier/order/tracking/store',[\App\Http\Controllers\OrderTrackingController::class,'store'])->name('supplier.order.tracking.store');
    Route::post('supplier/order/tracking/update',[\App\Http\Controllers\OrderTrackingController::class,'update'])->name('supplier.order.tracking.update');
//    finanace for supplier
    Route::get('supplier/finance/all',[\App\Http\Controllers\SupplierFinanceController::class,'index'])->name('supplier.finance.index');
    Route::get('supplier/finance/view/{id}',[\App\Http\Controllers\SupplierFinanceController::class,'show'])->name('supplier.finance.show');
//    finance for admin
    Route::get('admin/finance/all',[\App\Http\Controllers\FinanceController::class,'index'])->name('admin.finance.index');
    Route::get('admin/finance/view/{id}',[\App\Http\Controllers\FinanceController::class,'show'])->name('admin.finance.show');
    Route::get('admin/finance/pay/{id}',[\App\Http\Controllers\FinanceController::class,'payNow'])->name('admin.finance.pay');
});

// Laravel 8
Route::post('/pay', [App\Http\Controllers\PaymentController::class, 'redirectToGateway'])->name('pay');
Route::get('/payment/callback', [App\Http\Controllers\PaymentController::class, 'handleGatewayCallback']);


Route::get('get-orders/{shop}/{order?}',function ($shop,$order = null){
    $merchant_product = MerchantProduct::where('toShopify',1)->where('shopify_id', 7221813084338)->first();
    dd($merchant_product);
    if($order == null){
        $order_detail = "/{$order}.json";
    }
    $order_detail = ".json";

    $shop = \App\Models\User::where('id',$shop)->first();


    // Create options for the API
    $options = new \Osiset\BasicShopifyAPI\Options();
    $options->setType(true); // Makes it private
    $options->setVersion('2020-01');
    $options->setApiKey(env('SHOPIFY_API_KEY'));
    $options->setApiPassword($shop->password);

// Create the client and session
    $api = new \Osiset\BasicShopifyAPI\BasicShopifyAPI($options);
    $api->setSession(new \Osiset\BasicShopifyAPI\Session($shop->name));


    $response = $api->rest('GET', '/admin/orders'.$order_detail, ['status' => 'any']);
    $orders = json_decode(json_encode($response['body']->container['orders']));

    foreach($orders as $order){
        foreach ($order->line_items as $item) {
            $merchant_product = MerchantProduct::where('shopify_id', $item->product_id)->first();
            dump($item->product_id,$merchant_product);
            if ($merchant_product != null) {
//                dump('za');
            }
            else{
//                dump('store');
            }
        }
    }

});
