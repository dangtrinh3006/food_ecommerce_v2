<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\frontend\CommentController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//APIs routes for products
Route::get('/products','App\Http\Controllers\ProductController@getProducts');
Route::get('/product/{id}','App\Http\Controllers\ProductController@getProductByID');
Route::post('/add-product','App\Http\Controllers\ProductController@addProduct');
Route::put('/update-product','App\Http\Controllers\ProductController@updateProductAPI');
Route::delete("/del-product/{id}",'App\Http\Controllers\ProductController@deleteProductAPI');

//APIs routes for categories
Route::get('/categories','App\Http\Controllers\CategoriesController@getCategories');
Route::get('/category/{id}','App\Http\Controllers\CategoriesController@getCategoryByID');
Route::post('/add-category','App\Http\Controllers\CategoriesController@addCategory');
Route::put('/update-category','App\Http\Controllers\CategoriesController@updateCategoryAPI');
Route::delete('/del-category/{id}','App\Http\Controllers\CategoriesController@deleteCategoryAPI');

//APIs routes for coupons
Route::get('/coupons','App\Http\Controllers\frontend\CouponController@getCoupons');
Route::get('/coupon/{id}','App\Http\Controllers\frontend\CouponController@getCouponByID');
Route::post('add-coupon','App\Http\Controllers\frontend\CouponController@addCoupon');
Route::put('/update-coupon','App\Http\Controllers\frontend\CouponController@updateCouponAPI');
Route::delete('/del-coupon/{id}','App\Http\Controllers\frontend\CouponController@deleteCouponAPI');

//APIs routes for customers
Route::get('/customers','App\Http\Controllers\CustomerController@getCustomers');
Route::get('/customer/{id}','App\Http\Controllers\CustomerController@getCustomerByID');
Route::post('/add-customer','App\Http\Controllers\CustomerController@addCustomer');
Route::put('/update-customer','App\Http\Controllers\CustomerController@updateCustomerAPI');
Route::delete('/del-customer/{id}','App\Http\Controllers\CustomerController@deleteCustomerAPI');

//APIs routes for districts
Route::get('/districts','App\Http\Controllers\DistrictController@getDistricts');
Route::get('/district/{id}','App\Http\Controllers\DistrictController@getDistrictByID');
Route::post('/add-district','App\Http\Controllers\DistrictController@addDistrict');
Route::put('/update-district','App\Http\Controllers\DistrictController@updateDistrictAPI');
Route::delete('/del-district/{id}','App\Http\Controllers\DistrictController@deleteDistrictAPI');

//APIs routes for feeships
Route::get('/feeships','App\Http\Controllers\FeeShipController@getFeeShips');
Route::get('/feeship/{id}','App\Http\Controllers\FeeShipController@getFeeShipByID');
Route::post('/add-feeship','App\Http\Controllers\FeeShipController@addFeeShip');
Route::put('/update-feeship','App\Http\Controllers\FeeShipController@updateFeeShipAPI');
Route::delete('/del-feeship/{id}','App\Http\Controllers\FeeShipController@deleteFeeShipAPI');

//APIs routes for materials
Route::get('/materials','App\Http\Controllers\MaterialController@getMaterials');
Route::get('/material/{id}','App\Http\Controllers\MaterialController@getMaterialByID');
Route::post('/add-material','App\Http\Controllers\MaterialController@addMaterial');
Route::put('/update-material','App\Http\Controllers\MaterialController@updateMaterialAPI');
Route::delete("/del-material/{id}",'App\Http\Controllers\MaterialController@deleteMaterialAPI');

//APIs routes for materialUnit
Route::get('/materialUnits','App\Http\Controllers\MaterialUnitController@getMaterialUnits');
Route::get('/materialUnit/{id}','App\Http\Controllers\MaterialUnitController@getMaterialUnitByID');
Route::post('/add-materialUnit','App\Http\Controllers\MaterialUnitController@addMaterialUnit');
Route::put('/update-materialUnit','App\Http\Controllers\MaterialUnitController@updateMaterialUnitAPI');
Route::delete("/del-materialUnit/{id}",'App\Http\Controllers\MaterialUnitController@deleteMaterialUnitAPI');

//APIs routes for orders
Route::get('/orders','App\Http\Controllers\OrderController@getOrders');
Route::get('/order/{id}','App\Http\Controllers\OrderController@getOrderByID');
Route::post('/add-order','App\Http\Controllers\OrderController@addOrder');
Route::put('/update-order','App\Http\Controllers\OrderController@updateOrderAPI');
Route::delete("/del-order/{id}",'App\Http\Controllers\OrderController@deleteOrderAPI');

//APIs routes for order details
Route::get('/orderDetails','App\Http\Controllers\OrderDetailController@getOrderDetails');
Route::get('/orderDetail/{id}','App\Http\Controllers\OrderDetailController@getOrderDetailByID');


//APIs routes for order statisticals
Route::get('/orderStatisticals','App\Http\Controllers\OrderStatisticalController@getOrderStatisticals');
Route::get('/orderStatistical/{id}','App\Http\Controllers\OrderStatisticalController@getOrderStatisticalByID');

//APIs routes for payments
Route::get('/payments','App\Http\Controllers\PaymentController@getPayments');
Route::get('/payment/{id}','App\Http\Controllers\PaymentController@getPaymentByID');
Route::delete("/del-payment/{id}",'App\Http\Controllers\PaymentController@deletePaymentAPI');

//APIs routes for provinces
Route::get('/provinces','App\Http\Controllers\ProvinceController@getProvinces');
Route::get('/province/{id}','App\Http\Controllers\ProvinceController@getProvinceByID');
Route::post('/add-province','App\Http\Controllers\ProvinceController@addProvince');
Route::put('/update-province','App\Http\Controllers\ProvinceController@updateProvinceAPI');
Route::delete("/del-province/{id}",'App\Http\Controllers\ProvinceController@deleteProvincAPI');

//APIs routes for users
Route::get('/users','App\Http\Controllers\UserController@getUsers');
Route::get('/user/{id}','App\Http\Controllers\UserController@getUserByID');
Route::post('/add-user','App\Http\Controllers\UserController@addUser');
Route::put('/update-user','App\Http\Controllers\UserController@updateUserAPI');
Route::delete("/del-user/{id}",'App\Http\Controllers\UserController@deleteUserAPI');

//APIs routes for wards
Route::get('/wards','App\Http\Controllers\WardController@getWards');
Route::get('/ward/{id}','App\Http\Controllers\WardController@getWardByID');
Route::post('/add-ward','App\Http\Controllers\WardController@addWard');
Route::put('/update-ward','App\Http\Controllers\WardController@updateWardAPI');
Route::delete("/del-ward/{id}",'App\Http\Controllers\WardController@deleteWardAPI');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

?>



