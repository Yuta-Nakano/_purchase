<?php

use App\Http\Controllers\ProductAttachmentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductStandardController;
use App\Http\Controllers\TermRelationshipController;
use App\Http\Controllers\TermTaxonomyController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get(null, fn(Request $request) => response(['data' => ['message' => 'API activated.']], 200));

// TODO: publicとAdminをドメインで分ける
Route::post('register', [UserController::class, 'store'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

// Common
Route::get('product', [ProductController::class, 'index'])->name('product.index');
Route::get('product/{product:slug}', [ProductController::class, 'show'])->name('product.show');

Route::get('standard', [ProductStandardController::class, 'index'])->name('standerd.index');

Route::get('file', [FileController::class, 'index'])->name('file.index');
Route::get('file/{file:slug}', [FileController::class, 'show'])->name('file.show');

// Common:Authed
Route::post('user/register', [UserController::class, 'store'])->name('user.store');
Route::get('user/{user:name}', [UserController::class, 'show'])->name('user.show');
Route::patch('user/{user:name}', [UserController::class, 'update'])->name('user.update');
Route::delete('user/{user:name}', [UserController::class, 'destroy'])->name('user.destroy');

Route::get('user/{user:name}/payment', [UserPaymentController::class, 'index'])->name('user-payment.index');
Route::post('user/{user:name}/payment', [UserPaymentController::class, 'store'])->name('user-payment.store');
Route::get('user/{user:name}/payment/{payment}', [UserPaymentController::class, 'show'])->name('user-payment.show');
Route::patch('user/{user:name}/payment/{payment}', [UserPaymentController::class, 'update'])->name('user-payment.update');
Route::delete('user/{user:name}/payment/{payment}', [UserPaymentController::class, 'destroy'])->name('user-payment.destroy');

Route::get('user/{user:name}/address', [UserAddressController::class, 'index'])->name('user-address.index');
Route::post('user/{user:name}/address', [UserAddressController::class, 'store'])->name('user-address.store');
Route::get('user/{user:name}/address/{address:dist_name}', [UserAddressController::class, 'show'])->name('user-address.show');
Route::patch('user/{user:name}/address/{address:dist_name}', [UserAddressController::class, 'update'])->name('user-address.update');
Route::delete('user/{user:name}/address/{address:dist_name}', [UserAddressController::class, 'destroy'])->name('user-address.destroy');

Route::get('order', [OrderController::class, 'index'])->name('order.index');
Route::post('order', [OrderController::class, 'store'])->name('order.store');
Route::get('order/{order}', [OrderController::class, 'show'])->name('order.show');
Route::delete('order/{order}', [OrderController::class, 'destroy'])->name('order.destroy');

Route::get('order-detail', [OrderDetailController::class, 'index'])->name('order-detail.index');
Route::post('order-detail', [OrderDetailController::class, 'store'])->name('order-detail.store');
Route::get('order-detail/{orderDetail}', [OrderDetailController::class, 'show'])->name('order-detail.show');
Route::patch('order-detail/{orderDetail}', [OrderDetailController::class, 'update'])->name('order-detail.update');
Route::delete('order-detail/{orderDetail}', [OrderDetailController::class, 'destroy'])->name('order-detail.destroy');

// Admin
Route::post('file', [FileController::class, 'store'])->name('file.store');
Route::patch('file/{file}', [FileController::class, 'update'])->name('file.update');
Route::delete('file/{file}', [FileController::class, 'destroy'])->name('file.destroy');

Route::post('product', [ProductController::class, 'store'])->name('product.store');
Route::patch('product/{product}', [ProductController::class, 'update'])->name('product.update');
Route::delete('product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

Route::post('product/taxonomy', [TermRelationshipController::class, 'store'])->name('product-taxonomy.store');
Route::delete('product/taxonomy/{termRel}', [TermRelationshipController::class, 'destroy'])->name('product-taxonomy.destroy');

Route::post('product/standard', [ProductStandardController::class, 'store'])->name('product-standard.store');
Route::get('product/standard/{standard}', [ProductStandardController::class, 'show'])->name('product-standard.show');
Route::patch('product/standard/{standard}', [ProductStandardController::class, 'update'])->name('product-standard.update');
Route::delete('product/standard/{standard}', [ProductStandardController::class, 'destroy'])->name('product-standard.destroy');

Route::post('product/attachment', [ProductAttachmentController::class, 'store'])->name('product-attachment.store');
Route::delete('product/attachment/{attachment}', [ProductAttachmentController::class, 'destroy'])->name('product-attachment.destroy');

Route::get('category', [TermTaxonomyController::class, 'index'])->name('term-taxonomy.category.index');
Route::post('category', [TermTaxonomyController::class, 'store'])->name('term-taxonomy.category.store');
Route::get('category/{term:slug}', [TermTaxonomyController::class, 'show'])->name('term-taxonomy.category.show');
Route::patch('category/{term:slug}', [TermTaxonomyController::class, 'update'])->name('term-taxonomy.category.update');
Route::delete('category/{term:slug}', [TermTaxonomyController::class, 'destroy'])->name('term-taxonomy.category.destroy');

Route::get('tag', [TermTaxonomyController::class, 'index'])->name('term-taxonomy.tag.index');
Route::post('tag', [TermTaxonomyController::class, 'store'])->name('term-taxonomy.tag.store');
Route::get('tag/{term:slug}', [TermTaxonomyController::class, 'show'])->name('term-taxonomy.tag.show');
Route::patch('tag/{term:slug}', [TermTaxonomyController::class, 'update'])->name('term-taxonomy.tag.update');
Route::delete('tag/{term:slug}', [TermTaxonomyController::class, 'destroy'])->name('term-taxonomy.tag.destroy');


Route::get('user', [UserController::class, 'index'])->name('user.index');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('loggedin', [AuthController::class, 'loggedin'])->name('loggedin');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
