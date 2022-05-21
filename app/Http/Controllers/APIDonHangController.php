<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\TaiKhoan;
use App\Models\ChiTietDonHang;
use App\Models\SanPham;
use App\Http\Controllers\Controller;
use App\Models\ChiTietSanPham;
use App\Models\HinhAnh;
use Carbon\Carbon;
use Illuminate\Http\Request;


class APIDonHangController extends Controller
{
    # Lấy ds  sản phẩm 
    function themSanPhamVaoGio(Request $request, ChiTietSanPham $chiTietSanPham)
    {
        $sanpham = SanPham::where('id', $chiTietSanPham->san_pham_id)->first();
        $giohang = DonHang::where('tai_khoan_id', $request['id'])->where('trang_thai', -1)->first();
        if (empty($giohang)) {
            $donhang = DonHang::insert([
                'ten_nguoi_nhan' => '',
                'dia_chi_nguoi_nhan' => '',
                'sdt_nguoi_nhan' => '',
                'ghi_chu' => '',
                'trang_thai' => -1,
                'tai_khoan_id' => $request['id'],
                'tai_khoan_nhan_vien_id' => 3,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')
            ]);
            $donhangid = DonHang::where('tai_khoan_id', $request['id'])->where('trang_thai', -1)->select('don_hangs.id')->first();
            $chiTietDonHang = ChiTietDonHang::insert([
                'so_luong' => 1,
                'gia' => $sanpham->gia,
                'don_hang_id' => $donhangid->id,
                'trang_thai_danh_gia' => 0,
                'chi_tiet_san_pham_id' => $chiTietSanPham->id,
            ]);
            if ($chiTietDonHang == true) {
                return response()->json($chiTietDonHang, 200);
            }
            return response()->json('', 404);
        } else {
            $donhangid = DonHang::where('tai_khoan_id', $request['id'])->where('trang_thai', -1)->select('don_hangs.id')->first();
            $sptontaitronggio = ChiTietDonHang::where('chi_tiet_san_pham_id', $chiTietSanPham->id)->where('don_hang_id', $donhangid->id)->first();

            if (empty($sptontaitronggio)) {
                $chiTietDonHang = ChiTietDonHang::insert([
                    'so_luong' => 1,
                    'gia' => $sanpham->gia,
                    'don_hang_id' => $donhangid->id,
                    'trang_thai_danh_gia' => 0,
                    'chi_tiet_san_pham_id' => $chiTietSanPham->id,
                ]);
                if ($chiTietDonHang == true) {
                    return response()->json($chiTietDonHang, 200);
                }
                return response()->json('', 404);
            } else {
                $soluongsp = ChiTietDonHang::where('chi_tiet_san_pham_id', $chiTietSanPham->id)->select('chi_tiet_don_hangs.so_luong')->first();
                if ($soluongsp->so_luong < 10) {
                    $sptontaitronggio->fill([
                        'so_luong' => $sptontaitronggio->so_luong + 1,
                    ]);
                    $sptontaitronggio->save();
                    return response()->json($sptontaitronggio, 200);
                }
                return response()->json('', 404);
            }
        }
    }

    function layGioHang(TaiKhoan $taiKhoan)
    {
        $danhsach = DonHang::join('chi_tiet_don_hangs', 'chi_tiet_don_hangs.don_hang_id', '=', 'don_hangs.id')
            ->join('chi_tiet_san_phams', 'chi_tiet_san_phams.id', '=', 'chi_tiet_don_hangs.chi_tiet_san_pham_id')
            ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_san_phams.san_pham_id')
            ->join('thuong_hieus', 'thuong_hieus.id', '=', 'san_phams.thuong_hieu_id')
            // ->join('hinh_anhs', 'hinh_anhs.chi_tiet_san_pham_id', '=', 'chi_tiet_san_phams.id')
            ->join('tai_khoans', 'tai_khoans.id', '=', 'don_hangs.tai_khoan_id')
            ->join('sizes', 'sizes.id', '=', 'chi_tiet_san_phams.size_id')
            ->where('don_hangs.tai_khoan_id', $taiKhoan->id)
            ->where('don_hangs.trang_thai', -1)
            // ->where('hinh_anhs.hinh_dai_dien', '=', 1)
            ->select('chi_tiet_don_hangs.id', 'chi_tiet_san_phams.size_id', 'chi_tiet_san_phams.mau_id', 'chi_tiet_don_hangs.chi_tiet_san_pham_id', 'san_phams.ten_san_pham', 'san_phams.gia', 'chi_tiet_don_hangs.so_luong', 'thuong_hieus.ten_thuong_hieu')
            ->get();
        return response()->json($danhsach, 200);
    }

    function updateSoLuongSP(Request $request, ChiTietDonHang $chiTietDonHang)
    {
        $ctdh = ChiTietDonHang::where('chi_tiet_don_hangs.id', $chiTietDonHang->id)->first();
        $ctdh->fill([
            'so_luong' => (int)$request['soLuong'],
        ]);
        $ctdh->save();
        return response()->json($ctdh, 200);
    }

    function updateSizeSP(Request $request, ChiTietDonHang $chiTietDonHang)
    {
        $idctsp = ChiTietDonHang::where('chi_tiet_don_hangs.id', $chiTietDonHang->id)->select('chi_tiet_san_pham_id')->first();
        $idsp = ChiTietSanPham::where('id', $idctsp->chi_tiet_san_pham_id)->select('san_pham_id')->first();
        $idctspupdate = ChiTietSanPham::join('san_phams', 'san_phams.id', '=', 'chi_tiet_san_phams.san_pham_id')
            ->where('san_pham_id', $idsp->san_pham_id)
            ->where('size_id', $request['sizeid'])
            ->where('mau_id', $request['mauid'])
            ->select('chi_tiet_san_phams.id')
            ->first();
        $kiemtra = ChiTietDonHang::where('chi_tiet_don_hangs.id', $chiTietDonHang->id)
            ->where('chi_tiet_don_hangs.chi_tiet_san_pham_id', $idctspupdate->id)
            ->first();
        if (empty($kiemtra)) {
            $ctdh = ChiTietDonHang::where('chi_tiet_don_hangs.id', $chiTietDonHang->id)->first();
            $ctdh->fill([
                'chi_tiet_san_pham_id' => $idctspupdate->id,
            ]);
            $ctdh->save();
            return response()->json($ctdh, 200);
        }
        return response()->json('', 404);
    }
    function layHinhAnhSP(ChiTietSanPham $chiTietSanPham)
    {
        $idsp = ChiTietSanPham::where('id', $chiTietSanPham->id)->select('san_pham_id')->first();
        // return response()->json($idsp, 200);
        $idmau = ChiTietSanPham::where('id', $chiTietSanPham->id)->select('mau_id')->first();
        // return response()->json($idmau, 200);
        $hinhanh = SanPham::join('chi_tiet_san_phams', 'chi_tiet_san_phams.san_pham_id', '=', 'san_phams.id')
            ->join('hinh_anhs', 'hinh_anhs.chi_tiet_san_pham_id', '=', 'chi_tiet_san_phams.id')
            ->where('san_phams.id', $idsp->san_pham_id)
            ->where('hinh_anhs.hinh_dai_dien', '=', 1)
            ->where('chi_tiet_san_phams.mau_id', $idmau->mau_id)
            ->select('hinh_anhs.chi_tiet_san_pham_id', 'hinh_anhs.hinh_anh',)
            ->get();
        return response()->json($hinhanh, 200);
    }
    function xoaCTGH(ChiTietDonHang $chiTietDonHang)
    {
        $kq = $chiTietDonHang->delete();
        if ($kq == 1) {
            return response()->json('', 200);
        }
        return response()->json('', 404);
    }
    function thanhToan(Request $request)
    {
        $list = [];
        $iddonhang  = DonHang::where('tai_khoan_id', $request['taiKhoanId'])->where('trang_thai', -1)->first();
        $kiemtrasoluongCTDH = ChiTietDonHang::join('don_hangs', 'don_hangs.id', '=', 'chi_tiet_don_hangs.don_hang_id')
            ->join('chi_tiet_san_phams', 'chi_tiet_san_phams.id', '=', 'chi_tiet_don_hangs.chi_tiet_san_pham_id')
            ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_san_phams.san_pham_id')
            ->join('maus', 'maus.id', '=', 'chi_tiet_san_phams.mau_id')
            ->join('sizes', 'sizes.id', '=', 'chi_tiet_san_phams.size_id')
            ->where('don_hang_id', $iddonhang->id)
            // ->where('chi_tiet_don_hangs.so_luong', '>' ,'chi_tiet_san_phams.so_luong')
            ->select('chi_tiet_don_hangs.chi_tiet_san_pham_id', 'chi_tiet_don_hangs.so_luong', 'san_phams.ten_san_pham', 'san_phams.ten_san_pham', 'maus.ten_mau', 'sizes.ten_size')
            ->get();
        $kiemtrasoluongCTSP = ChiTietDonHang::join('don_hangs', 'don_hangs.id', '=', 'chi_tiet_don_hangs.don_hang_id')
            ->join('chi_tiet_san_phams', 'chi_tiet_san_phams.id', '=', 'chi_tiet_don_hangs.chi_tiet_san_pham_id')
            ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_san_phams.san_pham_id')
            ->join('maus', 'maus.id', '=', 'chi_tiet_san_phams.mau_id')
            ->join('sizes', 'sizes.id', '=', 'chi_tiet_san_phams.size_id')
            ->where('don_hang_id', $iddonhang->id)
            // ->where('chi_tiet_don_hangs.so_luong', '>' , 'chi_tiet_san_phams.so_luong')
            ->select('chi_tiet_san_phams.so_luong')
            ->get();
        for ($i = 0; $i < count($kiemtrasoluongCTDH); $i++) {
            if ((int)$kiemtrasoluongCTDH[$i]->so_luong > (int)$kiemtrasoluongCTSP[$i]->so_luong) {
                $list[] = $kiemtrasoluongCTDH[$i]->ten_san_pham . ' - ' . $kiemtrasoluongCTDH[$i]->ten_mau . ' - ' . $kiemtrasoluongCTDH[$i]->ten_size;
            }
        }
        if (empty($list)) {
            for ($i = 0; $i < count($kiemtrasoluongCTDH); $i++) {
                $chiTietSanPham = ChiTietSanPham::where('id', $kiemtrasoluongCTDH[$i]->chi_tiet_san_pham_id)->first();
                $chiTietSanPham->fill([
                    'so_luong' => (int)$chiTietSanPham->so_luong - (int)$kiemtrasoluongCTDH[$i]->so_luong,
                ]);
                $chiTietSanPham->save();
            }
            $iddonhang->fill([
                'ten_nguoi_nhan' => $request['tenNguoiNhan'],
                'dia_chi_nguoi_nhan' => $request['diaChiNguoiNhan'],
                'sdt_nguoi_nhan' => $request['sdtNguoiNhan'],
                'ghi_chu' => $request['ghiChu'],
                'trang_thai' => 0,
            ]);
            $iddonhang->save();
        }
        return response()->json($list, 200);
    }
    function layDonHang(Request $request)
    {
        $donhang = DonHang::where('tai_khoan_id', $request['taiKhoanId'])->where('trang_thai', '!=', -1)->get();
        return response()->json($donhang, 200);
    }
    function layCTDonHang(Request $request)
    {
        $danhsach = DonHang::join('chi_tiet_don_hangs', 'chi_tiet_don_hangs.don_hang_id', '=', 'don_hangs.id')
            ->join('chi_tiet_san_phams', 'chi_tiet_san_phams.id', '=', 'chi_tiet_don_hangs.chi_tiet_san_pham_id')
            ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_san_phams.san_pham_id')
            ->join('thuong_hieus', 'thuong_hieus.id', '=', 'san_phams.thuong_hieu_id')
            ->join('sizes', 'sizes.id', '=', 'chi_tiet_san_phams.size_id')
            // ->join('hinh_anhs', 'hinh_anhs.chi_tiet_san_pham_id', '=', 'chi_tiet_san_phams.id')
            ->join('tai_khoans', 'tai_khoans.id', '=', 'don_hangs.tai_khoan_id')
            ->where('don_hangs.id', $request['donHangId'])
            // ->where('hinh_anhs.hinh_dai_dien', '=', 1)
            ->select('chi_tiet_don_hangs.id', 'sizes.ten_size', 'chi_tiet_san_phams.mau_id', 'chi_tiet_don_hangs.chi_tiet_san_pham_id', 'san_phams.ten_san_pham', 'san_phams.gia', 'chi_tiet_don_hangs.so_luong', 'thuong_hieus.ten_thuong_hieu')
            ->get();
        return response()->json($danhsach, 200);
    }
    function huyDonHang(Request $request)
    {
        $donhang = DonHang::where('id', $request['donHangId'])->first();
        $donhang->fill([
            'trang_thai' => 4,
        ]);
        $donhang->save();
        return response()->json($donhang, 200);
    }
}
