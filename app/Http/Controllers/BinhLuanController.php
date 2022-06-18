<?php

namespace App\Http\Controllers;

use App\Models\BinhLuan;
use Illuminate\Http\Request;

class BinhLuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstbl = BinhLuan::join('tai_khoans', 'tai_khoans.id', '=', 'binh_luans.tai_khoan_id')
        ->join('san_phams', 'san_phams.id', '=', 'binh_luans.san_pham_id')
        ->select('binh_luans.id', 'binh_luans.noi_dung', 'tai_khoans.email', 'san_phams.ten_san_pham', 'binh_luans.trang_thai', 'binh_luans.created_at', 'binh_luans.updated_at')
        ->get();
        return view('admin/pages.comment', ['lstbl' => $lstbl]);
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
     * @param  \App\Http\Requests\StoreBinhLuanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BinhLuan  $binhLuan
     * @return \Illuminate\Http\Response
     */
    public function show(BinhLuan $binhLuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BinhLuan  $binhLuan
     * @return \Illuminate\Http\Response
     */
    public function edit(BinhLuan $binhLuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBinhLuanRequest  $request
     * @param  \App\Models\BinhLuan  $binhLuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BinhLuan $binhLuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BinhLuan  $binhLuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(BinhLuan $binhLuan)
    {
        //
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $comments = BinhLuan::join('tai_khoans', 'tai_khoans.id', '=', 'binh_luans.tai_khoan_id')
            ->join('san_phams', 'san_phams.id', '=', 'binh_luans.san_pham_id')
            ->select('binh_luans.id', 'binh_luans.noi_dung', 'tai_khoans.email', 'san_phams.ten_san_pham', 'binh_luans.trang_thai', 'binh_luans.created_at', 'binh_luans.updated_at')
            ->where('san_phams.ten_san_pham', 'LIKE', '%' . $request->search . '%')
            ->get();
            
            $stt = 0;

            if ($comments) {
                foreach ($comments as $key => $bl) {
                    $output .= '<tr>
                        <td>' . ++$stt . '</td>
                        <td>' . $bl->noi_dung . '</td>
                        <td>' . $bl->email . '</td>
                        <td>' . $bl->ten_san_pham . '</td>';
                        if($bl->trang_thai == 1) {
                            $output .= '<td>Hoạt Động</td>';
                        }
                        else {
                            $output .= '<td>Ngưng Hoạt Động</td>';
                        } 
                        
                        $output .= '
                        <td>' . $bl->created_at . '</td>
                        <td>' . $bl->updated_at . '</td>
                    </tr>';
                }
            }
            return Response($output);
        }
    }
}
