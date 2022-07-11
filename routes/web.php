<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BinhLuanController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\MauController;
use App\Http\Controllers\ThuongHieuController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\DonViTinhController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\ChiTietSanPhamController;
use App\Http\Controllers\LoaiSanPhamController;
use App\Http\Controllers\TaiKhoanController;
use App\Http\Controllers\LoaiTaiKhoanController;
use App\Http\Controllers\NguyenLieuController;
use App\Http\Controllers\NoiLamViecController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\YeuThichController;
use App\Http\Controllers\HinhAnhController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\RecoverPasswordController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ChiTietDonHangController;
use App\Http\Controllers\ChucVuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HoaDonController;
use App\Http\Controllers\LoaiKhuyenMaiController;
use App\Http\Controllers\KhuyenMaiController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PhanPhoiController;
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

Route::get('/dangky', function () {
    return view('register');
})->name('register')->middleware('IsLogin');

Route::post('/register',[TaiKhoanController::class, 'register'])->name('dangky')->middleware('IsLogin');

Route::get('vertifyEmail/{id}/{token}',[MailController::class,'verifyAccount']);

Route::get('sendMail',[MailController::class,'sendMailVerifyAccount'])->name('sendMailVerifyAccount');

Route::get('/thucpham/{key}/{page}',[SanPhamController::class,'index'])->name('productpage');

Route::get('/like/{id}',[DanhGiaController::class,'like'])->name('like')->middleware('CheckLogin');

Route::get('notLike/{id}',[DanhGiaController::class,'notLike'])->name('notLike');

//deleteAlotWish
Route::get('deleteAlotWish',[DanhGiaController::class,'notLikeAlot'])->name('notLikeAlot');

Route::get('/chitietsanpham/{id}',[SanPhamController::class,'show'])->name('productdetail');

Route::get('/wishlist', [DanhGiaController::class,'liked'])->name('wishlist')->middleware('CheckLogin');

// Route::get('/sale', function () {
//     return view('sale');
// });

Route::get('/feedback',[MailController::class,'feedback'])->name('feedback');

Route::get('/GiamGia',[SanPhamController::class,'sale'])->name('sale');

Route::get('/ThucAn',[SanPhamController::class,'food'])->name('food');

Route::get('/NuocUong',[SanPhamController::class,'drink'])->name('drink');

Route::get('/GioHang', [HoaDonController::class, 'cart'])->name('cart')->middleware('CheckLogin');

Route::get('/addCart', [HoaDonController::class, 'addCart'])->name('cart.add')->middleware('CheckLogin');

Route::get('/deleteProductInCart/{id}',[HoaDonController::class, 'deleteProductInCart'])->name('deleteProductInCart');

Route::get('/ThanhToan', [TaiKhoanController::class, 'checkout'])->middleware('CheckLogin')->name('checkout');

Route::get('capNhatSoLuong', [HoaDonController::class, 'capNhatSoLuong'])->name('capNhatSoLuong');

Route::get('/about', function () {
    return view('about');
});
Route::post('/checkout', [HoaDonController::class, 'thanhtoan'])->name('thanhtoan')->middleware('CheckLogin');

Route::get('/getVoucher',[HoaDonController::class, 'getVoucher']);

Route::get('/vnpay_payment', [HoaDonController::class, 'vnpay_payment'])->middleware('CheckLogin')->name('vnpayment');

Route::get('/checkout/vnpay_payment', [HoaDonController::class, 'vnpay_payment_updateDB'])->middleware('CheckLogin');

Route::get('/momo_payment', [HoaDonController::class, 'momo_payment'])->middleware('CheckLogin')->name('momopayment');

Route::get('/checkout/momo_payment', [HoaDonController::class, 'momoPay'])->middleware('CheckLogin');

Route::get('/searchSanPham', [SanPhamController::class, 'search'])->name('sanPham.search');

Route::get('/contact', function () {
    return view('contact');
});
Route::get('/Reverify_Email', function(){
    return view('verifyEmail');
});
Route::resource('sanPham', SanPhamController::class);

Route::post('send-mail', [ForgotPasswordController::class,'sendMailRecover'])->name('send-mail');

Route::post('recover-password', [RecoverPasswordController::class,'recoverPassword'])->name('recover-password');

Route::get('/recover', function () {
    return view("admin.pages.recoverpassword");
});

Route::get('/recover-success', function () {
    return view("admin.pages.success_recover");
});

Route::get('forgotpassword', function () {
    return view('admin.pages.forgotpassword');
});

Route::get('/login',function () {
    return view('login');
})->name('user.login')->middleware('IsLogin');

Route::get('/info/{id}',[TaiKhoanController::class,'show'])->name('user.info');

Route::get('/info/replace_password/{id}',[TaiKhoanController::class,'replace_password'])->name('user.info.replace_password');

Route::post('/replacePassword',[TaiKhoanController::class,'replace'])->name('replacePassword');

Route::get('/info/update_info/{id}',[TaiKhoanController::class,'updateInfo'])->name('user.info.update_info');

Route::post('updateInfo',[TaiKhoanController::class,'updateInfoUser'])->name('updateInfo');

Route::get('/info/history_order/{id}',[HoaDonController::class,'historyOrder'])->name('user.info.history_order');

Route::get('/info/history_order/{id}/orderdetail/{dh}',[HoaDonController::class,'historyOrderDetail'])->name('user.info.history_order_detail');

Route::post('cancelInvoice',[HoaDonController::class,'cancel'])->name('cancelInvoice');

Route::get('cancelComment/{id}/{productID}',[DanhGiaController::class,'cancel'])->name('cancelComment');

Route::post('comment',[DanhGiaController::class,'store'])->name('comment');

Route::get('/logout',[TaiKhoanController::class,'logout'])->name('user.logout');

Route::post('/accountLogin',[TaiKhoanController::class,'login'])->name('login');

Route::get('admin/login',[AuthController::class,'showLogin'])->name('loginadmin')->middleware('IsAdminLogin');

Route::post('adminLogin',[AuthController::class,'authenticate'])->name('AdminLogin');

Route::get('adminLogout',[AuthController::class,'logout'])->name('AdminLogout');
//Route::get('logout',[AuthController::class,'logout'])->name('logout');

//Route::post('login',[AuthController::class,'authenticate'])->name('login');

// Route::get('home', function () {
//     return view('pages.home');
// });

Route::post('report', [HomeController::class,'report'])->name('report');

Route::get('getDataWithYear',[HomeController::class,'getDataWithYear']);

Route::prefix('')->middleware('CheckAdminLogin')->group(function () {
    Route::get('admin/home',[HomeController::class,'index'])->name('homeadmin');

Route::resource('admin/loaiTaiKhoan', LoaiTaiKhoanController::class);

Route::get('/searchLoaiTaiKhoan', [LoaiTaiKhoanController::class, 'search'])->name('loaiTaiKhoan.search');

Route::resource('admin/taiKhoan', TaiKhoanController::class);

Route::get('/searchTaiKhoan', [TaiKhoanController::class, 'search'])->name('taiKhoan.search');

Route::resource('admin/loaiSanPham', LoaiSanPhamController::class);

Route::get('/searchLoaiSanPham', [LoaiSanPhamController::class, 'search'])->name('loaiSanPham.search');


// Route::get('chiTietSanPham/restore/one/{id}', [ChiTietSanPhamController::class, 'restore'])->name('chiTietSanPham.restore');

// Route::get('chiTietSanPham/restore/all/{id}', [ChiTietSanPhamController::class, 'restoreAll'])->name('chiTietSanPham.restore.all');

Route::get('admin/sanPham', [SanPhamController::class,'adminShow'])->name('sanpham.adminShow');

Route::get('admin/sanpham/destroy', [SanPhamController::class,'destroy'])->name('sanpham.destroy');

Route::get('admin/sanpham/edit/{id}', [SanPhamController::class,'edit'])->name('sanpham.edit');

Route::get('admin/sanpham/detail/{id}', [SanPhamController::class,'detail'])->name('sanpham.detail');

Route::post('admin/sanpham/update', [SanPhamController::class,'update'])->name('sanpham.update');

Route::get('admin/sanpham/search', [SanPhamController::class,'search']);

Route::get('admin/invoice',[HoaDonController::class,'invoiceAdminShow']);

Route::get('admin/invoice/edit/{id}',[HoaDonController::class,'edit'])->name('invoice.edit');


Route::get('/PDF/{id}',[HoaDonController::class,'bill'])->name('bill.pdf');

Route::post('admin/invoice/update',[HoaDonController::class,'update'])->name('invoice.update');

Route::get('searchInvoice',[HoaDonController::class,'search']);

Route::resource('admin/nguyenLieu', NguyenLieuController::class);

Route::get('/searchNguyenLieu', [NguyenLieuController::class, 'search'])->name('nguyenLieu.search');

Route::resource('admin/noiLamViec', NoiLamViecController::class);

Route::get('/searchNoiLamViec', [NoiLamViecController::class, 'search'])->name('noiLamViec.search');

Route::resource('admin/danhGia', DanhGiaController::class);

Route::get('/searchDanhGia', [DanhGiaController::class, 'search'])->name('danhGia.search');

Route::resource('admin/chucVu', ChucVuController::class);

Route::get('/searchChucVu', [ChucVuController::class, 'search'])->name('chucVu.search');

Route::resource('admin/loaiKhuyenMai', LoaiKhuyenMaiController::class);

Route::get('/searchLoaiKhuyenMai', [LoaiKhuyenMaiController::class, 'search'])->name('loaiKhuyenMai.search');

Route::resource('admin/khuyenMai', KhuyenMaiController::class);

Route::get('/searchKhuyenMai', [KhuyenMaiController::class, 'search'])->name('khuyenMai.search');

Route::resource('admin/binhLuan', BinhLuanController::class);

Route::get('/searchBinhLuan', [BinhLuanController::class, 'search'])->name('binhLuan.search');

Route::resource('admin/nhanVien', NhanVienController::class);

Route::get('/searchNhanVien', [NhanVienController::class, 'search'])->name('nhanVien.search');

Route::resource('admin/donViTinh', DonViTinhController::class);

Route::get('/searchDonViTinh', [DonViTinhController::class, 'search'])->name('donViTinh.search');

Route::resource('admin/phanPhoi', PhanPhoiController::class);

Route::get('/searchPhanPhoi', [PhanPhoiController::class, 'search'])->name('phanPhoi.search');
});