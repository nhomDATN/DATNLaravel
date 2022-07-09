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
    public function liked()
    {
        $wishlist = DB::table('danh_gias')
        ->join('san_phams', 'san_phams.id', '=','san_pham_id')
        ->where('tai_khoan_id',Session::get('UserId'))
        ->where('yeu_thich',1)
        ->where('danh_gias.trang_thai', 1)
        ->get();
        return view('wish_list',['wishList' => $wishlist]);
    }
    public function notLike($id)
    {
        DB::update('update danh_gias set yeu_thich = 0 where tai_khoan_id = ? and san_pham_id = ?',  [Session::get('UserId'),$id]);
        return redirect()->back();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function like($id)
    {
        $liked = DB::table('danh_gias')
        ->where('tai_khoan_id','=',Session::get('UserId'))
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
            if($liked[0]->yeu_thich == 1)
                DB::update('update danh_gias set yeu_thich = 0 where tai_khoan_id = ? and san_pham_id = ?', [Session::get('UserId'),$id]);
            else
                DB::update('update danh_gias set yeu_thich = 1 where tai_khoan_id = ? and san_pham_id = ?', [Session::get('UserId'),$id]);
        }
        return redirect()->back();
       
    }
    public function notLikeAlot(Request $request)
    {
       
        $listId ='';
        for($i = 0; $i < count($request->deleteCheck);$i++) {
            $listId .= $request->deleteCheck[$i];
            if($i != count($request->deleteCheck) - 1)
            $listId .= ',';
        }
       $rq =  DB::update('update danh_gias set yeu_thich = 0 where tai_khoan_id = '.Session::get('UserId').' and san_pham_id in ('.$listId.')');
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
        $check = DB::table('danh_gias')
        ->where('tai_khoan_id',Session::get('UserId'))
        ->where('san_pham_id',$request->id)
        ->get();
        if(count($check) == 0)
       { 
        DB::insert('insert into binh_luans (noi_dung,tai_khoan_id,san_pham_id,trang_thai,created_at) values (?,?,?,?,?)',[$request->danh_gia,Session::get('UserId'),$request->id,1,now()]);
        DB::insert('insert into danh_gias (yeu_thich,so_sao,tai_khoan_id,san_pham_id,trang_thai,created_at) values (?,?,?,?,?,?)',[0,$request->star,Session::get('UserId'),$request->id,1,now()]);
        }
        else
        {
            $check2 = DB::table('binh_luans')
            ->where('tai_khoan_id',Session::get('UserId'))
            ->where('san_pham_id',$request->id)
            ->get();
            if(count($check2) > 0)
              DB::update('update binh_luans set noi_dung = ?, updated_at = ? where tai_khoan_id = ? and san_pham_id = ?',[$request->danh_gia,now(),Session::get('UserId'),$request->id]);
            else
                DB::insert('insert into binh_luans (noi_dung,tai_khoan_id,san_pham_id,trang_thai,created_at) values (?,?,?,?,?)',[$request->danh_gia,Session::get('UserId'),$request->id,1,now()]);
            DB::update('update danh_gias set yeu_thich = 0,so_sao = ?, updated_at = ? where tai_khoan_id = ? and san_pham_id = ?',[$request->star,now(),Session::get('UserId'),$request->id]);
            }
        return redirect()->back();
    }
    public function cancel($id,$productID)
    {
        DB::delete('update danh_gias set so_sao = 0 where tai_khoan_id = ? and san_pham_id = ?',[$id,$productID]);
        DB::delete('delete from binh_luans where tai_khoan_id = ? and san_pham_id = ?',[$id,$productID]);
        return back();
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
            
            $stt = 0;

            if ($reviews) {
                foreach ($reviews as $key => $dg) {
                    $output .= '<tr>
                        <td>' . ++$stt . '</td>';
                        if($dg->yeu_thich == 1) {
                            $output .= '<td>Yêu Thích</td>';
                        }
                        else {
                            $output .= '<td>Ngưng Hoạt Động</td>';
                        } 
                        $output .= '<td>';

                            for ($i = 1; $i <= $dg->so_sao; $i++)
                                $output .= '<i class="nav-icon fas fa-star" style="color: orange"> </i>';

                        $output .='</td> 

                        <td>' . $dg->email . '</td>
                        <td>' . $dg->ten_san_pham . '</td>';
                        if($dg->trang_thai == 1) {
                            $output .= '<td>Hoạt Động</td>';
                        }
                        else {
                            $output .= '<td>Ngưng Hoạt Động</td>';
                        } 
                        
                        $output .= '
                        <td>' . $dg->created_at . '</td>
                        <td>' . $dg->updated_at . '</td>
                    </tr>';
                }
            }
            return Response($output);
        }
    }
}
