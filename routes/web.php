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

Route::get('/', [SanPhamController::class, 'home'])->name('home');

Route::get('/search',[SanPhamController::class,'search'])->name('productSearch');

Route::get('/login', function () {
    return view('login');
})->name('login');

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

Route::get('/', function () {
    return view('pages');
});

Route::get('/recover', function () {
    return view("pages.recoverpassword");
});

Route::get('/recover-success', function () {
    return view("pages.success_recover");
});

Route::get('forgotpassword', function () {
    return view('pages.forgotpassword');
});

Route::get('login',[AuthController::class,'showLogin'])->name('login')->middleware('CheckUser');

Route::get('logout',[AuthController::class,'logout'])->name('logout');

Route::post('login',[AuthController::class,'authenticate'])->name('login');

// Route::get('home', function () {
//     return view('pages.home');
// });
Route::get('home',[HomeController::class,'index'])->name('home')->middleware('CheckLogout');

Route::resource('sanPham', SanPhamController::class);

Route::get('/searchSanPham', [SanPhamController::class, 'search'])->name('sanPham.search');

Route::get('/searchSanPhamXoa', [SanPhamController::class, 'searchSanPhamXoa'])->name('sanPhamXoa.search');

Route::get('sanPham/restore/one/{id}', [SanPhamController::class, 'restore'])->name('sanPham.restore');

Route::get('sanPham/restore/all/{id}', [SanPhamController::class, 'restoreAll'])->name('sanPham.restore.all');

Route::resource('loaiSanPham', LoaiSanPhamController::class)->middleware('CheckLogout');

Route::get('/searchLoaiSanPham', [LoaiSanPhamController::class, 'search'])->name('loaiSanPham.search');

Route::get('/searchLoaiSanPhamXoa', [LoaiSanPhamController::class, 'searchLoaiSanPhamXoa'])->name('loaiSanPhamXoa.search');

Route::get('loaiSanPham/restore/one/{id}', [LoaiSanPhamController::class, 'restore'])->name('loaiSanPham.restore');

Route::get('loaiSanPham/restore/all/{id}', [LoaiSanPhamController::class, 'restoreAll'])->name('loaiSanPham.restore.all');

Route::resource('chiTietSanPham',ChiTietSanPhamController::class)->middleware('CheckLogout');

Route::get('/searchChiTietSanPham', [ChiTietSanPhamController::class, 'search'])->name('chiTietSanPham.search');

Route::get('/searchChiTietSanPhamXoa', [ChiTietSanPhamController::class, 'searchChiTietSanPhamXoa'])->name('chiTietSanPhamXoa.search');

Route::get('chiTietSanPham/restore/one/{id}', [ChiTietSanPhamController::class, 'restore'])->name('chiTietSanPham.restore');

Route::get('chiTietSanPham/restore/all/{id}', [ChiTietSanPhamController::class, 'restoreAll'])->name('chiTietSanPham.restore.all');

Route::resource('mau', MauController::class)->middleware('CheckLogout');

Route::get('/searchMau', [MauController::class, 'search'])->name('mau.search');

Route::get('/searchMauXoa', [MauController::class, 'searchMauXoa'])->name('mauXoa.search');

Route::get('mau/restore/one/{id}', [MauController::class, 'restore'])->name('mau.restore');

Route::get('mau/restore/all/{id}', [MauController::class, 'restoreAll'])->name('mau.restore.all');

Route::resource('thuongHieu',ThuongHieuController::class)->middleware('CheckLogout');

Route::get('/searchThuongHieu', [ThuongHieuController::class, 'search'])->name('thuongHieu.search');

Route::get('/searchThuongHieuXoa', [ThuongHieuController::class, 'searchThuongHieuXoa'])->name('thuongHieuXoa.search');

Route::get('thuongHieu/restore/one/{id}', [ThuongHieuController::class, 'restore'])->name('thuongHieu.restore');

Route::get('thuongHieu/restore/all/{id}', [ThuongHieuController::class, 'restoreAll'])->name('thuongHieu.restore.all');

Route::resource('danhGia',DanhGiaController::class)->middleware('CheckLogout');

Route::get('/searchDanhGia', [DanhGiaController::class, 'search'])->name('danhGia.search');

Route::get('/searchDanhGiaXoa', [DanhGiaController::class, 'searchDanhGiaXoa'])->name('danhGiaXoa.search');

Route::get('danhGia/restore/one/{id}', [DanhGiaController::class, 'restore'])->name('danhGia.restore');

Route::get('danhGia/restore/all/{id}', [DanhGiaController::class, 'restoreAll'])->name('danhGia.restore.all');

Route::resource('donHang',DonHangController::class)->middleware('CheckLogout');

Route::get('/searchDonHang', [DonHangController::class, 'search'])->name('donHang.search');

Route::resource('taiKhoan', TaiKhoanController::class)->middleware('CheckLogout');

Route::get('/searchTaiKhoan', [TaiKhoanController::class, 'search'])->name('taiKhoan.search');

Route::get('/searchTaiKhoanXoa', [TaiKhoanController::class, 'searchTaiKhoanXoa'])->name('taiKhoanXoa.search');

Route::get('taiKhoan/restore/one/{id}', [TaiKhoanController::class, 'restore'])->name('taiKhoan.restore');

Route::get('taiKhoan/restore/all/{id}', [TaiKhoanController::class, 'restoreAll'])->name('taiKhoan.restore.all');

Route::resource('loaiTaiKhoan', LoaiTaiKhoanController::class)->middleware('CheckLogout');

Route::get('/searchLoaiTaiKhoan', [LoaiTaiKhoanController::class, 'search'])->name('loaiTaiKhoan.search');

Route::get('/searchLoaiTaiKhoanXoa', [LoaiTaiKhoanController::class, 'searchLoaiTaiKhoanXoa'])->name('loaiTaiKhoanXoa.search');

Route::get('loaiTaiKhoan/restore/one/{id}', [LoaiTaiKhoanController::class, 'restore'])->name('loaiTaiKhoan.restore');

Route::get('loaiTaiKhoan/restore/all/{id}', [LoaiTaiKhoanController::class, 'restoreAll'])->name('loaiTaiKhoan.restore.all');

Route::resource('size', SizeController::class)->middleware('CheckLogout');

Route::get('/searchSize', [SizeController::class, 'search'])->name('size.search');

Route::get('/searchSizeXoa', [SizeController::class, 'searchSizeXoa'])->name('sizeXoa.search');

Route::get('size/restore/one/{id}', [SizeController::class, 'restore'])->name('size.restore');

Route::get('size/restore/all/{id}', [SizeController::class, 'restoreAll'])->name('size.restore.all');

Route::resource('yeuThich', YeuThichController::class)->middleware('CheckLogout');

Route::get('/searchYeuThich', [YeuThichController::class, 'search'])->name('yeuThich.search');

Route::resource('hinhAnh', HinhAnhController::class)->middleware('CheckLogout');

Route::get('/searchHinhAnh', [HinhAnhController::class, 'search'])->name('hinhAnh.search');

Route::get('/searchHinhAnhXoa', [HinhAnhController::class, 'searchHinhAnhXoa'])->name('hinhAnhXoa.search');

Route::get('hinhAnh/restore/one/{id}', [HinhAnhController::class, 'restore'])->name('hinhAnh.restore');

Route::get('hinhAnh/restore/all/{id}', [HinhAnhController::class, 'restoreAll'])->name('hinhAnh.restore.all');

Route::resource('banner', BannerController::class)->middleware('CheckLogout');

Route::get('/searchBanner', [BannerController::class, 'search'])->name('banner.search');

Route::get('/searchBannerXoa', [BannerController::class, 'searchBannerXoa'])->name('bannerXoa.search');

Route::get('banner/restore/one/{id}', [BannerController::class, 'restore'])->name('banner.restore');

Route::get('banner/restore/all/{id}', [BannerController::class, 'restoreAll'])->name('banner.restore.all');

Route::get('/searchChiTietDonHang', [ChiTietDonHangController::class, 'search'])->name('chiTietDonHang.search');