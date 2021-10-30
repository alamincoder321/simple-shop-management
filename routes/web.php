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

Auth::routes(['register' => false]);


Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//======================= Employee route ==========================
Route::resource('/employee', App\Http\Controllers\EmployeeController::class);
Route::get('/employee/active/{id}', [App\Http\Controllers\EmployeeController::class, 'active'])->name('employee.active');
Route::get('/employee/inactive/{id}', [App\Http\Controllers\EmployeeController::class, 'inactive'])->name('employee.inactive');
//======================= End Employee route =======================

//======================= Customer route ===========================
Route::resource('/customer', App\Http\Controllers\CustomerController::class);
Route::get('/customer/active/{id}', [App\Http\Controllers\CustomerController::class, 'active'])->name('customer.active');
Route::get('/customer/inactive/{id}', [App\Http\Controllers\CustomerController::class, 'inactive'])->name('customer.inactive');
//======================= End Customer route =======================

//======================= Brand route ===========================
Route::resource('/brand', App\Http\Controllers\BrandController::class);
Route::get('/brand/active/{id}', [App\Http\Controllers\BrandController::class, 'active'])->name('brand.active');
Route::get('/brand/inactive/{id}', [App\Http\Controllers\BrandController::class, 'inactive'])->name('brand.inactive');
//======================= End Brand route =======================

//======================= Category route ===========================
Route::resource('/category', App\Http\Controllers\CategoryController::class);
Route::get('/category/active/{id}', [App\Http\Controllers\CategoryController::class, 'active'])->name('category.active');
Route::get('/category/inactive/{id}', [App\Http\Controllers\CategoryController::class, 'inactive'])->name('category.inactive');
//======================= End Category route =======================

//======================= Product route ===========================
Route::resource('/product', App\Http\Controllers\ProductController::class);
Route::get('/product/active/{id}', [App\Http\Controllers\ProductController::class, 'active'])->name('product.active');
Route::get('/product/inactive/{id}', [App\Http\Controllers\ProductController::class, 'inactive'])->name('product.inactive');
//======================= End Product route =======================

//======================= Pos route =======================
Route::get('/pos', [App\Http\Controllers\PosController::class, 'index'])->name('pos');
//======================= End Pos route =======================


//======================= Cart route =======================
Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'index'])->name('cart.add');
Route::post('/cart/update/{rowId}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{rowId}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::post('/pos/invoice', [App\Http\Controllers\CartController::class, 'Ivoice'])->name('invoice');
Route::post('/pos/finalinvoice', [App\Http\Controllers\CartController::class, 'FinalInvoice'])->name('final.invoice');
//======================= End cart route =======================

//======================= Order route =======================
Route::get('/order', [App\Http\Controllers\OrderController::class, 'index'])->name('order.index');
Route::post('/order/dueupdate/{id}', [App\Http\Controllers\OrderController::class, 'updatedue'])->name('update.due');
Route::get('/order/show/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('order.show');
