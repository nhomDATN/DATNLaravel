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
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Session::put('productType',['Tất cả','Gà Rán','Khoai Tây Chiên','Bánh Mì','Hamburger','Trà Sữa']);
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

    public function sale(Request $request)
    {
        $lstsp = SanPham::join('khuyen_mais', 'khuyen_mais.id', '=', 'san_phams.khuyen_mai_id')
        ->select('san_phams.id', 'hinh', 'ten_san_pham', 'gia')
        ->where('san_phams.khuyen_mai_id', 2)
        ->get();
        return view('sale', ['lstsp'=>$lstsp]);
    }

    
    public function home(Request $request)
    {
        $lstsp = SanPham::Paginate(4);
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
        $daban = 0;
        $binhchon = 0;
        $so_sao = 0;
        $select = DB::select('select so_sao from danh_gias where san_pham_id = ?', [$request->id]);
        if(!empty($select))
        {
            foreach($select as $i)
            {
                $so_sao += $i->so_sao;
            }
           
            $binhchon = count($select);
            $so_sao = ($so_sao*1.0)/($binhchon*1.0);
        }
        $select = DB::select('select so_luong from chi_tiet_hoa_dons,hoa_dons where hoa_don_id = hoa_dons.id and san_pham_id = ? and trang_thai != "Giỏ Hàng"', [$request->id]);
        if(!empty($select))
        {
            foreach($select as $i)
            {
                $daban += $i->so_luong;
            }
        }
        
        $product = SanPham::where('id','=',$request->id)->get();
        $select = SanPham::select('tim_kiem')->where('id','=',$request->id)->get();
        $explore = explode(",",$select[0]->tim_kiem);
        $string = '';
        $dem = 1;
        foreach($explore as $items)
        {
            $string .= "tim_kiem like '%$items%'";
            if($dem++ != count($explore))
                $string .= " or ";
        }
        //dd($string);
        $listProduct = DB::select('select id,ten_san_pham,gia,hinh,mo_ta from san_phams where '.$string.' and id != '.$request->id.' limit 4');
       
        return view('productdetail',['listProduct'=>$listProduct,'product' =>$product,'daban' =>$daban,'so_sao'=>$so_sao,'binhchon'=>$binhchon]);
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
