<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APISanPhamController;
use App\Http\Controllers\APILoaiSanPhamController;
use App\Http\Controllers\APITaiKhoanController;
use App\Http\Controllers\APIDonHangController;
use App\Http\Controllers\APISizeController;
use App\Http\Controllers\APIYeuThichController;
use App\Http\Controllers\APIDanhGiaController;
use App\Http\Controllers\APIBannerController;

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

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::get('san-pham/danh-sach', [APISanPhamController::class, 'layDanhSach']);

Route::get('san-pham/chitietsanpham/{chiTietSanPham}', [APISanPhamController::class, 'layChiTietSanPham']);

Route::get('san-pham/danh-sach-recom', [APISanPhamController::class, 'layDanhSachSanPhamRecom']);

Route::get('san-pham/danh-sach-fea', [APISanPhamController::class, 'layDanhSachSanPhamFea']);

Route::get('san-pham/danh-sach-new', [APISanPhamController::class, 'layDanhSachSanPhamNew']);

Route::post('tai-khoan/dang-nhap',[APITaiKhoanController::class, 'dangNhap']);

Route::post('tai-khoan/dang-ky',[APITaiKhoanController::class, 'dangKy']);

Route::post('tai-khoan/lay-lai-mat-khau',[APITaiKhoanController::class, 'layLaiMatKhau']);

Route::get('san-pham/danh-sach-theo-loai/{loaiSanPham}', [APISanPhamController::class, 'layDanhSachTheoLoai']);

Route::get('loai-san-pham/danh-sach-loai-sp', [APILoaiSanPhamController::class, 'layDanhSachLoaiSP']);

Route::get('banner/danh-sach-banner', [APIBannerController::class, 'layDanhSachBanner']);

Route::post('gio-hang/them-san-pham/{chiTietSanPham}', [APIDonHangController::class, 'themSanPhamVaoGio']);

Route::get('gio-hang/lay-gio-hang/{taiKhoan}', [APIDonHangController::class, 'layGioHang']);

Route::get('size/lay-size/{chiTietSanPham}', [APISizeController::class, 'laySize']);

Route::post('gio-hang/update-so-luong-ctdh/{chiTietDonHang}', [APIDonHangController::class, 'updateSoLuongSP']);

Route::post('gio-hang/update-size-ctdh/{chiTietDonHang}', [APIDonHangController::class, 'updateSizeSP']);

Route::get('gio-hang/lay-hinh-anh/{chiTietSanPham}', [APIDonHangController::class, 'layHinhAnhSP']);

Route::post('tai-khoan/lay-id-tai-khoan', [APITaiKhoanController::class, 'layIDTaiKhoan']);

Route::get('gio-hang/delete-ctgh/{chiTietDonHang}', [APIDonHangController::class, 'xoaCTGH']);

Route::post('tai-khoan/lay-thong-tin-tai-khoan', [APITaiKhoanController::class, 'layThongTinTaiKhoan']);

Route::post('gio-hang/thanh-toan', [APIDonHangController::class, 'thanhToan']);

Route::post('don-hang/lay-don-hang', [APIDonHangController::class, 'layDonHang']);

Route::post('don-hang/lay-ct-don-hang', [APIDonHangController::class, 'layCTDonHang']);

Route::post('don-hang/huy-don-hang', [APIDonHangController::class, 'huyDonHang']);

Route::post('search', [APISanPhamController::class, 'search']);

Route::post('tai-khoan/doi-mat-khau', [APITaiKhoanController::class, 'doiMatKhau']);

Route::post('tai-khoan/cap-nhat-tai-khoan', [APITaiKhoanController::class, 'capNhatTaiKhoan']);

Route::post('yeu-thich/them-hoac-xoa-yeu-thich', [APIYeuThichController::class, 'themHoacXoaYeuThich']);

Route::post('yeu-thich/lay-trang-thai', [APIYeuThichController::class, 'layTrangThai']);

Route::post('yeu-thich/lay-danh-sach-yeu-thich', [APIYeuThichController::class, 'layDanhSachYeuThich']);

Route::post('yeu-thich/xoa-yeu-thich', [APIYeuThichController::class, 'xoaYeuThich']);

Route::post('danh-gia/lay-danh-sach-chua-danh-gia', [APIDanhGiaController::class, 'layDanhSachChuaDanhGia']);

Route::post('danh-gia/lay-danh-sach-da-danh-gia', [APIDanhGiaController::class, 'layDanhSachDaDanhGia']);

Route::post('danh-gia/them-danh-gia', [APIDanhGiaController::class, 'themDanhGia']);

Route::post('danh-gia/lay-danh-gia-theo-san-pham', [APIDanhGiaController::class, 'layDanhGiaTheoSanPham']);

Route::post('danh-gia/trung-binh-sao', [APIDanhGiaController::class, 'trungBinhSao']);

Route::post('tai-khoan/dang-nhap-bang-social', [APITaiKhoanController::class, 'dangNhapBangSocial']);