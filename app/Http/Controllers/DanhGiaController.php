<?php

namespace App\Http\Controllers;

use App\Models\DanhGia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class DanhGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstdg = DanhGia::join('tai_khoans', 'tai_khoans.id', '=', 'danh_gias.tai_khoan_id')
        ->join('san_phams', 'san_phams.id', '=', 'danh_gias.san_pham_id')
        ->select('danh_gias.id', 'danh_gias.yeu_thich', 'danh_gias.so_sao', 'tai_khoans.email', 'san_phams.ten_san_pham', 'danh_gias.trang_thai', 'danh_gias.created_at', 'danh_gias.updated_at')
        ->get();
        return view('admin/pages.review', ['lstdg' => $lstdg]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function like($id)
    {
        $liked = DB::table('danh_gias')
        ->where('tai_khoans_id','=',Session::get('UserId'))
        ->where('san_pham_id','=',$id)
        ->get();
        if(count($liked) == 0)
        {
            $like = new DanhGia();
            $like->fill([
                'yeu_thich' => 1,
                'so_sao' => 0,
                'tai_khoan_id' => Session::get('UserId'),
                'san_pham_id' => $id,
                'trang_thai' => 1
            ]);
            $like->save();
        }
        else
        {
            if($liked->yeu_thich == 1)
                DB::update('update danh_gias set yeu_thich = 0 where tai_khoan_id = ?, san_pham_id = ?', [Session::get('UserId'),$id]);
            else
                DB::update('update danh_gias set yeu_thich = 1 where tai_khoan_id = ?, san_pham_id = ?', [Session::get('UserId'),$id]);
        }
        return redirect()->back();
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDanhGiaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DanhGia  $danhGia
     * @return \Illuminate\Http\Response
     */
    public function show(DanhGia $danhGia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DanhGia  $danhGia
     * @return \Illuminate\Http\Response
     */
    public function edit(DanhGia $danhGia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDanhGiaRequest  $request
     * @param  \App\Models\DanhGia  $danhGia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DanhGia $danhGia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DanhGia  $danhGia
     * @return \Illuminate\Http\Response
     */
    public function destroy(DanhGia $danhGia)
    {
        //
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $reviews = DanhGia::join('tai_khoans', 'tai_khoans.id', '=', 'danh_gias.tai_khoan_id')
            ->join('san_phams', 'san_phams.id', '=', 'danh_gias.san_pham_id')
            ->select('danh_gias.id', 'danh_gias.yeu_thich', 'danh_gias.so_sao', 'tai_khoans.email', 'san_phams.ten_san_pham', 'danh_gias.trang_thai', 'danh_gias.created_at', 'danh_gias.updated_at')
            ->where('san_phams.ten_san_pham', 'LIKE', '%' . $request->search . '%')
            ->get();
            
            if ($reviews) {
                foreach ($reviews as $key => $dg) {
                    $output .= '<tr>
                        <td>' . $dg->id . '</td>
                        <td>' . $dg->yeu_thich . '</td>
                        <td>' . $dg->so_sao . '</td>
                        <td>' . $dg->email . '</td>
                        <td>' . $dg->ten_san_pham . '</td>
                        <td>' . $dg->trang_thai . '</td>
                        <td>' . $dg->created_at . '</td>
                        <td>' . $dg->updated_at . '</td>
                    </tr>';
                }
            }
            return Response($output);
        }
    }
}
