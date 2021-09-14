<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductStatusController;
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
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth.shopify'])->name('home');

//This will redirect user to login page.
Route::get('/app/login', function () {
    if (Auth::user()) {
        return redirect()->route('home');
    }
    return view('login');
})->name('login');

Route::group(['middleware' => ['auth.shopify', 'billable']], function () {
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
});

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
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
});
