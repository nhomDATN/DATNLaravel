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

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/product', function () {
    return view('product');
});

Route::get('/wishlist', function () {
    return view('wishlist');
});

Route::get('/sale', function () {
    return view('sale');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/blogdetail', function () {
    return view('blogdetail');
});

Route::get('/contact', function () {
    return view('contact');
});