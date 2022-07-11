<?php

namespace App\Http\Controllers;

use App\Models\ChiTietSanPham;
use App\Models\HoaDon;
use App\Models\SanPham;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function index()
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $donhangmoi = HoaDon::where('trang_thai', '0')->whereYear('created_at',$now->year)->count();
        $taikhoankhachhang = TaiKhoan::where('loai_tai_khoan_id', '2')->whereYear('created_at',$now->year)->count();
        $soluong = HoaDon::join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.hoa_don_id', '=', 'hoa_dons.id')
            ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_hoa_dons.san_pham_id')
            ->whereYear('hoa_dons.created_at',$now->year)
            ->where('hoa_dons.trang_thai', '=', 3)
            ->select('chi_tiet_hoa_dons.so_luong')
            ->get();
        $gia = HoaDon::join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.hoa_don_id', '=', 'hoa_dons.id')
            ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_hoa_dons.san_pham_id')
            ->whereYear('hoa_dons.created_at',$now->year)
            ->where('hoa_dons.trang_thai', '=', 3)
            ->select('san_phams.gia')
            ->get();
        $tongdoanhthu = 0;
        for ($i = 0; $i < count($gia); $i++) {
            $tongdoanhthu = $tongdoanhthu + $gia[$i]->gia * $soluong[$i]->so_luong;
        }
        $doanhthutungthang = HoaDon::join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.hoa_don_id', '=', 'hoa_dons.id')
        ->whereYear('hoa_dons.created_at', '=', now()->year)
        ->where('trang_thai', '=', 3)
        ->select(DB::raw("MONTH(hoa_dons.created_at) month"),
         DB::raw('sum(chi_tiet_hoa_dons.so_luong * chi_tiet_hoa_dons.gia) doanhthu'))
        ->groupBy('month')
        ->get();
        //dd($doanhthutungthang);
        return view('admin/pages.home', ['donhangmoi' => $donhangmoi, 'taikhoankhachhang' => $taikhoankhachhang, 'tongdoanhthu' => $tongdoanhthu, 'doanhthutungthang' => $doanhthutungthang]);
    
        
    }
    public function getDataWithYear(Request $request)
    {
        $donhangmoi = HoaDon::where('trang_thai', '0')->whereYear('created_at',$request->year)->count();
        $taikhoankhachhang = TaiKhoan::where('loai_tai_khoan_id', '2')->whereYear('created_at',$request->year)->count();
        $soluong = HoaDon::join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.hoa_don_id', '=', 'hoa_dons.id')
            ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_hoa_dons.san_pham_id')
            ->whereYear('hoa_dons.created_at',$request->year)
            ->where('hoa_dons.trang_thai', '=', 3)
            ->select('chi_tiet_hoa_dons.so_luong')
            ->get();
        $gia = HoaDon::join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.hoa_don_id', '=', 'hoa_dons.id')
            ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_hoa_dons.san_pham_id')
            ->whereYear('hoa_dons.created_at',$request->year)
            ->where('hoa_dons.trang_thai', '=', 3)
            ->select('san_phams.gia')
            ->get();
        $tongdoanhthu = 0;
        for ($i = 0; $i < count($gia); $i++) {
            $tongdoanhthu = $tongdoanhthu + $gia[$i]->gia * $soluong[$i]->so_luong;
        }
        $doanhthutungthang = HoaDon::join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.hoa_don_id', '=', 'hoa_dons.id')
        ->whereYear('hoa_dons.created_at', '=', $request->year)
        ->where('trang_thai', '=', 3)
        ->select(DB::raw("MONTH(hoa_dons.created_at) month"),
         DB::raw('sum(chi_tiet_hoa_dons.so_luong * chi_tiet_hoa_dons.gia) doanhthu'))
        ->groupBy('month')
        ->get();
        $data = [
            'tongdonhang' => count($soluong),
            'doanhthu' => $tongdoanhthu,
            'taikhoankhachhang' => $taikhoankhachhang,
            'doanhthutungthang' => $doanhthutungthang
        ];
        return response()->json($data);
    }
    public function report(Request $request)
    {
        $doanhthutungthang = HoaDon::join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.hoa_don_id', '=', 'hoa_dons.id')
        ->whereYear('hoa_dons.created_at', '=', $request->year)
        ->where('trang_thai', '=', 3)
        ->select(DB::raw("MONTH(hoa_dons.created_at) month"),
         DB::raw('sum(chi_tiet_hoa_dons.so_luong * chi_tiet_hoa_dons.gia) doanhthu'))
        ->groupBy('month')
        ->get();
        $dataMonth = [0,0,0,0,0,0,0,0,0,0,0,0];
        // dd(array_search(1,$dataMonth));
        foreach($doanhthutungthang as $data)
        {
            $dataMonth[$data->month -1] = $data->doanhthu;
        }
        $adminReport = DB::table('tai_khoans')->where('id', '=',Session::get('AdminId'))->get();
        $data = [
            'data' => $dataMonth,
            'admin' => $adminReport[0]->ho_ten,
            'time' => Carbon::now('Asia/Ho_Chi_Minh')
        ];
        $pdf = PDF::loadView('admin.pages.report',['data' => $data]);
        return $pdf->download('statistic.pdf');
    }
}
