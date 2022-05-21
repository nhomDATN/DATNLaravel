<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\ChiTietDonHang;
use App\Models\ChiTietSanPham;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstdh = DonHang::join('tai_khoans as khach', 'khach.id', '=', 'don_hangs.tai_khoan_id')
            ->join('tai_khoans as nv', 'nv.id', '=', 'don_hangs.tai_khoan_nhan_vien_id')
            ->select('khach.email as khachemail', 'nv.email as nvemail', 'don_hangs.*')->get();
        return view('pages.order', ['lstdh' => $lstdh]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDonHangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DonHang  $donHang
     * @return \Illuminate\Http\Response
     */
    public function show(DonHang $donHang)
    {
        $lstctdh = ChiTietDonHang::join('chi_tiet_san_phams', 'chi_tiet_san_phams.id', '=', 'chi_tiet_don_hangs.chi_tiet_san_pham_id')
            ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_san_phams.san_pham_id')
            ->join('maus', 'maus.id', '=', 'chi_tiet_san_phams.mau_id')
            ->join('sizes', 'sizes.id', '=', 'chi_tiet_san_phams.size_id')
            ->select('san_phams.ten_san_pham', 'maus.ten_mau', 'sizes.ten_size', 'chi_tiet_don_hangs.*')
            ->where('don_hang_id', '=', $donHang->id)->get();
        $tongtien=0;
        $tongsoluong=0;
        foreach($lstctdh as $ctdh){
            $tongtien += $ctdh->gia * $ctdh->so_luong;
            $tongsoluong +=$ctdh->so_luong;
        }
        return view('pages.detail_order', ['lstctdh' => $lstctdh,'tongtien'=>$tongtien,'tongsoluong'=>$tongsoluong, 'donHang'=>$donHang]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DonHang  $donHang
     * @return \Illuminate\Http\Response
     */
    public function edit(DonHang $donHang)
    {
        return view('edit.edit_order', ['dh' => $donHang]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDonHangRequest  $request
     * @param  \App\Models\DonHang  $donHang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DonHang $donHang)
    {
        $dsChiTietDonHang = ChiTietDonHang::where('don_hang_id', '=', $donHang->id)->get();
        if ($request->input('trangthai') == 4) {
            foreach ($dsChiTietDonHang as $ctdh) {
                $ctsp = ChiTietSanPham::where('id', '=', $ctdh->chi_tiet_san_pham_id)->first();
                $ctsp->fill([
                    'so_luong' => $ctsp->so_luong + $ctdh->so_luong,
                ]);
                $ctsp->save();
            }
        }

        $donHang->fill([
            'trang_thai' => $request->input('trangthai'),
        ]);
        $donHang->save();

        return Redirect::route('donHang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DonHang  $donHang
     * @return \Illuminate\Http\Response
     */
    public function destroy(DonHang $donHang)
    {
        //
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $donhangs = DonHang::join('tai_khoans as khach', 'khach.id', '=', 'don_hangs.tai_khoan_id')
                ->join('tai_khoans as nv', 'nv.id', '=', 'don_hangs.tai_khoan_nhan_vien_id')
                ->select('khach.email as khachemail', 'nv.email as nvemail', 'don_hangs.*')
                ->where('khach.email', 'LIKE', '%' . $request->search . '%')
                ->get();
            if ($donhangs) {
                foreach ($donhangs as $key => $dh) {
                    $trangthai = '';
                    switch ($dh->trang_thai) {
                        case (-1):
                            $trangthai = 'Cart';
                            break;
                        case (0):
                            $trangthai = 'Processing';
                            break;
                        case (1):
                            $trangthai = 'Processed';
                            break;
                        case (2):
                            $trangthai = 'Delivering';
                            break;
                        case (3):
                            $trangthai = 'Delivered';
                            break;
                        default:
                            $trangthai = 'Canceled';
                    }
                    $output .= '<tr>
                    <td>' . $dh->id . '</td>
                    <td>' . $dh->ten_nguoi_nhan . '</td>
                    <td>' . $dh->dia_chi_nguoi_nhan . '</td>
                    <td>' . $dh->sdt_nguoi_nhan . '</td>
                    <td>' . $dh->ghi_chu . '</td>
                    <td>' . $dh->khachemail . '</td>
                    <td>' . $dh->nvemail . '</td>
                    <td>' . $trangthai . '</td>
                    <td>' . $dh->created_at . '</td>
                    <td>' . $dh->updated_at . '</td>
                    <td style=";width: 20px;">
                     <a href="' . route('donHang.edit', ['donHang' => $dh]) . '">
                     <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fas fa-edit"></i></button>
                     </a>
                     </td>
                     <td style="width: 20px;">
                     <form method="post" action="' . route('donHang.destroy', ['donHang' => $dh]) . '">
                     ' . @csrf_field() . '
                     ' . @method_field("DELETE") . '
                     <button type="submit" class="btn btn-default btn-sm checkbox-toggle"><i class="fas fa-trash"></i></button>
                     </form>
                     </td>
                    </tr>';
                }
            }

            return Response($output);
        }
    }
}
