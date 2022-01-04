<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

//Home Page
Route::get('/', \App\Http\Livewire\Home::class)->name('home');

Route::get('AboutUs', \App\Http\Livewire\AboutUs::class)->name('aboutUs');
Route::get('Shop', \App\Http\Livewire\Shop::class)->name('shop');
Route::get('cart', \App\Http\Livewire\CartShopping::class)->name('cart');
Route::get('Checkout', \App\Http\Livewire\Checkout::class)->name('checkout');
Route::get('Contactus', \App\Http\Livewire\Contactus::class)->name('contactus');
Route::get('wishlist', \App\Http\Livewire\Wishlist::class)->name('wishlist');
Route::get('thankYou', \App\Http\Livewire\ThankYou::class)->name('thankYou');

//For Admin
//Route::get('admin/Dashboard', \App\Http\Livewire\Admin\AdminDashboard::class)->middleware(['auth:sanctum','verified','AuthAdmin'])->name('admin.dashboard');
Route::middleware(['auth:sanctum','verified','AuthAdmin'])->group(function (){
    Route::get('admin/Dashboard', \App\Http\Livewire\Admin\AdminDashboard::class)->name('admin.dashboard');
    Route::get('admin/Categories', \App\Http\Livewire\Admin\Categoriestable::class)->name('admin.categories');
    Route::get('admin/product', \App\Http\Livewire\Admin\ProductsTable::class)->name('admin.products');
    Route::get('admin/slider', \App\Http\Livewire\Admin\SliderHome::class)->name('admin.slider');
    Route::get('admin/orders', \App\Http\Livewire\Admin\Orders::class)->name('admin.orders');
    Route::get('admin/order/{orderId}', \App\Http\Livewire\Admin\OrdersDetail::class)->name('admin.order.detail');

});

//For user and customer
Route::middleware(['auth:sanctum','verified'])->group(function (){
    Route::get('user/Dashboard', \App\Http\Livewire\User\UserDashboard::class)->name('user.dashboard');
    Route::get('user/orders', \App\Http\Livewire\User\UserOrders::class)->name('user.orders');
    Route::get('user/order/{orderId}', \App\Http\Livewire\User\UserOrderDetail::class)->name('user.order.detail');
    Route::get('user/changePassword', \App\Http\Livewire\User\UserChangePassword::class)->name('user.changePassword');
});

//Detail products
Route::get('detail/{slug}',\App\Http\Livewire\Detail::class)->name('detail');
//Category
Route::get('category/{slug}',\App\Http\Livewire\Categories::class)->name('category');
//Search
Route::get('search/{search}',\App\Http\Livewire\ResultSearch::class)->name('search');
