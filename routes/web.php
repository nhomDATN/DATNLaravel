<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\MauController;
use App\Http\Controllers\ThuongHieuController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\ChiTietSanPhamController;
use App\Http\Controllers\LoaiSanPhamController;
use App\Http\Controllers\TaiKhoanController;
use App\Http\Controllers\LoaiTaiKhoanController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\YeuThichController;
use App\Http\Controllers\HinhAnhController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\RecoverPasswordController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ChiTietDonHangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HoaDonController;

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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [SanPhamController::class, 'home'])->name('homeuser');

Route::get('/search',[SanPhamController::class,'search'])->name('productSearch');

// Route::get('/login', function () {
//     return view('login');
// })->name('loginuser');

Route::get('/register', function () {
    return view('register');
})->name('register');


Route::get('/product/{key}/{page}',[SanPhamController::class,'index'])->name('productpage');

Route::get('/productdetail/{id}',[SanPhamController::class,'show'])->name('productdetail');

Route::get('/wishlist', function () {
    return view('wishlist');
});

// Route::get('/sale', function () {
//     return view('sale');
// });

Route::get('/sale',[SanPhamController::class,'sale'])->name('sale');



// Route::get('/cart', function () {
//     return view('cart');
// });

Route::get('/cart', [HoaDonController::class, 'cart']);
Route::post('/cart', [HoaDonController::class, 'addCart'])->name('cart.add');

// Route::post('/checkout', function () {
//     return view('checkout');
// });

// Route::get('/checkout', function () {
//     return view('checkout');
// });

Route::get('/checkout', [TaiKhoanController::class, 'checkout']);
Route::post('/capNhatSoLuong', [HoaDonController::class, 'capNhatSoLuong'])->name('capNhatSoLuong');

Route::get('/about', function () {
    return view('about');
});

// Route::get('/blog', function () {
//     return view('blog');
// });

Route::get('/blog', [SanPhamController::class, 'blog']);

Route::get('/searchSanPham', [SanPhamController::class, 'search'])->name('sanPham.search');

// Route::get('/blogdetail', function () {
//     return view('blogdetail');
// });

Route::get('/blogdetail', [SanPhamController::class, 'blogdetail']);

Route::get('/contact', function () {
    return view('contact');
});

Route::resource('sanPham', SanPhamController::class);

Route::post('send-mail', [ForgotPasswordController::class,'sendMailRecover'])->name('send-mail');

Route::post('recover-password', [RecoverPasswordController::class,'recoverPassword'])->name('recover-password');

Route::get('/recover', function () {
    return view("pages.recoverpassword");
});

Route::get('/recover-success', function () {
    return view("pages.success_recover");
});

Route::get('forgotpassword', function () {
    return view('pages.forgotpassword');
});

Route::get('login',[AuthController::class,'showLogin'])->name('loginadmin');

Route::get('logout',[AuthController::class,'logout'])->name('logout');

Route::post('login',[AuthController::class,'authenticate'])->name('login');

// Route::get('home', function () {
//     return view('pages.home');
// });
Route::get('admin/home',[HomeController::class,'index'])->name('homeadmin');

Route::resource('admin/loaiTaiKhoan', LoaiTaiKhoanController::class);

Route::get('/searchLoaiTaiKhoan', [LoaiTaiKhoanController::class, 'search'])->name('loaiTaiKhoan.search');

Route::resource('admin/taiKhoan', TaiKhoanController::class);

Route::get('/searchTaiKhoan', [TaiKhoanController::class, 'search'])->name('taiKhoan.search');

Route::resource('admin/loaiSanPham', LoaiSanPhamController::class);


// Route::get('chiTietSanPham/restore/one/{id}', [ChiTietSanPhamController::class, 'restore'])->name('chiTietSanPham.restore');

// Route::get('chiTietSanPham/restore/all/{id}', [ChiTietSanPhamController::class, 'restoreAll'])->name('chiTietSanPham.restore.all');

Route::resource('admin/sanPham', SanPhamController::class);