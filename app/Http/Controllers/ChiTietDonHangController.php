<?php

namespace App\Http\Controllers;

use App\Models\ChiTietDonHang;
use Illuminate\Http\Request;

class ChiTietDonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreChiTietDonHangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChiTietDonHang  $chiTietDonHang
     * @return \Illuminate\Http\Response
     */
    public function show(ChiTietDonHang $chiTietDonHang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChiTietDonHang  $chiTietDonHang
     * @return \Illuminate\Http\Response
     */
    public function edit(ChiTietDonHang $chiTietDonHang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChiTietDonHangRequest  $request
     * @param  \App\Models\ChiTietDonHang  $chiTietDonHang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChiTietDonHang $chiTietDonHang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChiTietDonHang  $chiTietDonHang
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChiTietDonHang $chiTietDonHang)
    {
        //
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $orderdetails = ChiTietDonHang::join('chi_tiet_san_phams', 'chi_tiet_san_phams.id', '=', 'chi_tiet_don_hangs.chi_tiet_san_pham_id')
            ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_san_phams.san_pham_id')
            ->join('maus', 'maus.id', '=', 'chi_tiet_san_phams.mau_id')
            ->join('sizes', 'sizes.id', '=', 'chi_tiet_san_phams.size_id')
            ->select('san_phams.ten_san_pham', 'maus.ten_mau', 'sizes.ten_size', 'chi_tiet_don_hangs.*')
            ->where('don_hang_id', '=', $request->donHang)
            ->where('san_phams.ten_san_pham', 'LIKE', '%' . $request->search . '%')
            ->get();
            if ($orderdetails) {
                foreach ($orderdetails as $key => $ctdh) {
                    $trangthai = '';
                    switch ($ctdh->trang_thai) {
                        case (1):
                            $trangthai = 'Reviewed';
                            break;
                        default:
                            $trangthai = 'Not Yet Review';
                        }
                    $output .= '<tr>
                    <td>' . $ctdh->id . '</td>
                    <td>' . $ctdh->don_hang_id . '</td>
                    <td>' . $ctdh->ten_san_pham . '</td>
                    <td>' . $ctdh->ten_mau . '</td>
                    <td>' . $ctdh->ten_size . '</td>
                    <td>' . $ctdh->so_luong . '</td>
                    <td>' . $ctdh->gia . '</td>
                    <td>' . $trangthai . '</td>
                    </tr>';
                }
            }

            return Response($output);
        }
    }
}
