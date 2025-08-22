<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\DeliveryTypeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogPageController;
use App\Http\Controllers\ContactPageController;
use App\Http\Controllers\AboutPageController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\SitemapController;

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Authentication routes
Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', 'logout');
        Route::get('account', 'account');
        Route::put('account', 'updateAccount');
        Route::put('change-password', 'changePassword');
    });
});


Route::get('banners', [BannerController::class, 'all']);

Route::get('categories', [CategoryController::class, 'all']);
Route::get('colors', [ColorController::class, 'all']);
Route::get('sizes', [SizeController::class, 'all']);
Route::get('delivery-types', [DeliveryTypeController::class, 'all']);
Route::get('faqs', [FaqController::class, 'all']);

Route::post('contact', [ContactController::class, 'store']);

Route::get('home-page', [HomePageController::class, 'show']);
Route::get('blog-page', [BlogPageController::class, 'show']);
Route::get('contact-page', [ContactPageController::class, 'show']);
Route::get('about-page', [AboutPageController::class, 'show']);
Route::get('product-page', [ProductPageController::class, 'show']);

// Sitemap route
Route::get('sitemap', [SitemapController::class, 'index']);

Route::controller(BlogController::class)->prefix('blogs')->group(function () {
    Route::get('/', 'all');
    Route::get('{slug}', 'find');
});

Route::controller(ProductController::class)->prefix('products')->group(function () {
    Route::get('/', 'all');
    Route::get('{slug}', 'find');
    Route::get('{slug}/similar', 'similar');
});

// Protected routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    // Cart routes
    Route::controller(CartController::class)->prefix('cart')->group(function () {
        Route::get('/', 'index');
        Route::post('add', 'add');
        Route::put('{id}', 'update');
        Route::delete('{id}', 'remove');
        Route::delete('/', 'clear');
    });

    // Favorites routes
    Route::controller(FavoriteController::class)->prefix('favorites')->group(function () {
        Route::get('/', 'index');
        Route::post('toggle', 'toggle');
        Route::get('check/{productId}', 'check');
    });

    // Order routes
    Route::controller(OrderController::class)->prefix('orders')->group(function () {
        Route::get('/', 'index');
        Route::get('{id}', 'show');
        Route::post('checkout', 'checkout');
    });
});
