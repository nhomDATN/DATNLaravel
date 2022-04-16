<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Http\Requests\StoreSanPhamRequest;
use App\Http\Requests\UpdateSanPhamRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class SanPhamController extends Controller
{
    public function __contruct()
    {
        Session::put('productType',['Tất cả','Gà Rán','Khoai Tây Chiên','Bánh Mì','Hamburger','Trà Sữa']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $active= $request->key;
        $offset = (($request->page - 1) * 8);
        $select = '';
        $page = $request->page;
        if($active != "Tất cả")
            $select = $request->key;
        $allProduct = DB::select('select mo_ta from san_phams where mo_ta like "%'.$select.'%" ');
        $product =  DB::select('select mo_ta,san_phams.id,ten_san_pham,gia,gia_tri,khuyen_mai_id,hinh from san_phams,khuyen_mais where khuyen_mai_id = khuyen_mais.id and mo_ta like "%'.$select.'%" limit 8 offset '.$offset.'');
        $maxpage = ceil(count($allProduct)/8);
        //dd($allProduct);
      return view('product',['key' => $active , 'product' =>$product,'page' => $page,'maxpage' => $maxpage]);

    }
    
    public function home(Request $request)
    {
        $lstsp = SanPham::all();
        return view('index', ['lstsp'=>$lstsp]);
    }

    public function blog(Request $request)
    {
        $lstsp = SanPham::all();
        return view('blog', ['lstsp'=>$lstsp]);
    }

    public function blogdetail(Request $request)
    {
        $lstsp = SanPham::all();
        $sanPham =SanPham::where('id','=',$request->get('sanPham'))->first();
        return view('blogdetail', ['lstsp'=>$lstsp]);
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
     * @param  \App\Http\Requests\StoreSanPhamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SanPham  $sanPham
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $product = SanPham::where('id','=',$request->id)->get();
        $select = '';
        if($request->key != "Tất cả")
            $select= $request->key;
        $listProduct = DB::select('select id,ten_san_pham,gia,hinh,mo_ta from san_phams where mo_ta like "%'.$select.'%" limit 4');
        return view('productdetail',['key'=>$request->key,'listProduct'=>$listProduct,'product' =>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SanPham  $sanPham
     * @return \Illuminate\Http\Response
     */
    public function edit(SanPham $sanPham)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSanPhamRequest  $request
     * @param  \App\Models\SanPham  $sanPham
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SanPham $sanPham)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SanPham  $sanPham
     * @return \Illuminate\Http\Response
     */
    public function destroy(SanPham $sanPham)
    {
        //
    }

    // public function search(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $output = '';
    //         $sanphams = SanPham::all()
    //         ->select('san_phams.id','san_phams.ten_san_pham','san_phams.mo_ta','san_phams.gia','loai_san_pham_id','san_phams.created_at')
    //         ->where('ten_san_pham', 'LIKE', '%' . $request->search . '%')
    //         ->get();
    //         if ($sanphams) {
    //             foreach ($sanphams as $key => $sp) {
    //                 $output .= '<tr>
    //                 <td>' . $sp->id . '</td>
    //                 <td>' . $sp->ten_san_pham . '</td>
    //                 <td>' . $sp->mo_ta . '</td>
    //                 <td>' . $sp->gia . '</td>
    //                 <td>' . $sp->hinh . '</td>
    //                 <td><img src=" ' . asset("/storage/$sp->hinh_anh") . ' " style="width: 100px;"></td>
    //                 <td>' . $sp->loai_san_pham_id . '</td>
    //                 <td>' . $sp->created_at . '</td>
    //                 <td>' . $sp->updated_at . '</td>
                    
                    
    //                 </tr>';
    //             }
    //         }

    //         return Response($output);
    //     }
    // }
}
