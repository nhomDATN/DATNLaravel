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
        Session::put('productType',['Tất cả','Gà Rán','Khoai Tây Chiên','Bánh Mì','Trà Sữa']);
        $active= $request->key;
        $limit = 16;
        $offset = (($request->page - 1) * $limit);
        $select = '';
        $page = $request->page;
        if($active != "Tất cả")
            $select = $request->key;
        $allProduct = DB::select('select mo_ta from san_phams where mo_ta like "%'.$select.'%" ');
        $product =  DB::select('select mo_ta,san_phams.id,ten_san_pham,gia,gia_tri,khuyen_mai_id,hinh 
        from san_phams, khuyen_mais where  khuyen_mai_id = khuyen_mais.id 
        and mo_ta like "%'.$select.'%" 
        limit '.$limit.' 
        offset '.$offset.'');
        $maxpage = ceil(count($allProduct)/$limit);
        //dd($allProduct);
      return view('product',['key' => $active , 'product' =>$product,'page' => $page,'maxpage' => $maxpage]);

    }

    public function sale(Request $request)
    {
        $page = 1;
        $offset = 0;
        $limit = 16;
        if(!empty($request->page))
        {
            $page = $request->page;
            $offset = (($request->page - 1) * $limit);
        }
        $allSales = SanPham::join('khuyen_mais', 'khuyen_mais.id', '=', 'san_phams.khuyen_mai_id')
        ->select('san_phams.id', 'hinh', 'ten_san_pham', 'gia','gia_tri','khuyen_mai_id')
        ->where('gia_tri','>',0)
        ->get();

        $lstsp = SanPham::join('khuyen_mais', 'khuyen_mais.id', '=', 'san_phams.khuyen_mai_id')
        ->select('san_phams.id', 'hinh', 'ten_san_pham', 'gia','gia_tri','khuyen_mai_id')
        ->where('gia_tri','>',0)
        ->limit($limit)
        ->offset($offset)
        ->get();
        $maxpage = ceil(count($allSales)/$limit);
        return view('sale', ['lstsp'=>$lstsp,'page'=>$page,'maxpage'=>$maxpage]);
    }
    public function food(Request $request)
    {
        $page = 1;
        $limit = 16;
        $offset = 0;
        if(!empty($request->page))
        {
            $page = $request->page;
            $offset = (($request->page - 1) * $limit);
        }
        $allSales =  SanPham::select('san_phams.id', 'hinh', 'ten_san_pham', 'gia','gia_tri','khuyen_mai_id')
        ->join('khuyen_mais','khuyen_mais.id','=','khuyen_mai_id')
        ->where('loai_san_pham_id','=',1)
        ->get();

        $lstsp = SanPham::select('san_phams.id', 'hinh', 'ten_san_pham', 'gia','gia_tri','khuyen_mai_id')
        ->join('khuyen_mais','khuyen_mais.id','=','khuyen_mai_id')
        ->where('loai_san_pham_id','=',1)
        ->limit($limit)
        ->offset($offset)
        ->get();
        $maxpage = ceil(count($allSales)/$limit);
        return view('food', ['lstsp'=>$lstsp,'page'=>$page,'maxpage'=>$maxpage]);
    }
    public function drink(Request $request)
    {
        $page = 1;
        $offset = 0;
        $limit = 16;

        if(!empty($request->page))
        {
            $page = $request->page;
            $offset = (($request->page - 1) * $limit);
        }

        $allSales =  SanPham::select('san_phams.id', 'hinh', 'ten_san_pham', 'gia','gia_tri','khuyen_mai_id')
        ->join('khuyen_mais','khuyen_mais.id','=','khuyen_mai_id')
        ->where('loai_san_pham_id','=',2)
        ->get();

        $lstsp = SanPham::select('san_phams.id', 'hinh', 'ten_san_pham', 'gia','gia_tri','khuyen_mai_id')
        ->join('khuyen_mais','khuyen_mais.id','=','khuyen_mai_id')
        ->where('loai_san_pham_id','=',2)
        ->limit($limit)
        ->offset($offset)
        ->get();
         $maxpage = ceil(count($allSales)/$limit);
        return view('drink', ['lstsp'=>$lstsp,'page'=>$page,'maxpage'=>$maxpage]);
    }
    
    public function home(Request $request)
    {
        //dd($request->session()->all());
        $lstsp = SanPham::join('khuyen_mais', 'khuyen_mais.id', '=', 'san_phams.khuyen_mai_id')
        ->join('danh_gias','danh_gias.san_pham_id', '=', 'san_phams.id')
        ->where('yeu_thich',1)
        ->select([
            DB::raw('Count(san_phams.id) as tong_sp'),
            DB::raw('san_phams.id'),
            DB::raw('hinh'),
            DB::raw('ten_san_pham'),
            DB::raw('gia'),
            DB::raw('gia_tri'),
            DB::raw('khuyen_mai_id'),
        ])
        ->groupBy('san_phams.id','hinh', 'ten_san_pham', 'gia','gia_tri','khuyen_mai_id')
        ->limit(8)
        ->orderByDESC('tong_sp')
        ->get();
        $lstsp2 = SanPham::join('khuyen_mais', 'khuyen_mais.id', '=', 'san_phams.khuyen_mai_id')
        ->join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.san_pham_id', '=', 'san_phams.id')
        ->join('hoa_dons', 'hoa_dons.id', '=','chi_tiet_hoa_dons.hoa_don_id')
        ->where('hoa_dons.trang_thai',3)
        ->select([
            DB::raw('Count(san_phams.id) as tong_sp'),
            DB::raw('san_phams.id'),
            DB::raw('hinh'),
            DB::raw('ten_san_pham'),
            DB::raw('san_phams.gia'),
            DB::raw('gia_tri'),
            DB::raw('khuyen_mai_id'),
        ])
        ->groupBy('san_phams.id', 'hinh', 'ten_san_pham', 'san_phams.gia','gia_tri','khuyen_mai_id')
        ->orderByDESC('tong_sp')
        ->limit(8)
        ->get();
        //dd($lstsp2);
        return view('index', ['lstsp'=>$lstsp,'lstsp2'=>$lstsp2]);
    }
    
    public function adminShow()
    {
        $product = SanPham::all()->where('trang_thai',1);
        return view('admin.pages.product',['lstPD'=>$product]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lstloai = DB::table('loai_san_phams')->get();
        $lstNL = DB::table('nguyen_lieus')->where('trang_thai',1)->get();
        $lstKM = DB::table('khuyen_mais')->where('loai_khuyen_mai_id',2)->get();
      return view('admin.add.add_product',['lstKM' =>$lstKM,'lstloai'=>$lstloai,'lstNL' => $lstNL]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSanPhamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
       $check = DB::table('san_phams')->where('ten_san_pham',$request->tensp)->get();
       if(count($check)==0)
       {
        $key ='';
        $tim_kiem = explode(',',$request->key);
        for($i = 0; $i < count($tim_kiem); $i++)
        {
            $tim_kiem[$i] = trim($tim_kiem[$i]);
        }
        $key .= implode(', ',$tim_kiem);
        $sanpham = DB::table('san_phams')->insert([
        'hinh' => "1",
        'ten_san_pham' =>$request->tensp,
        'mo_ta'=>$request->mota,
        'gia' => $request->gia,
        'loai_san_pham_id' => $request->loaisp,
        'khuyen_mai_id' => $request->khuyenmai,
        'tim_kiem' => $key
        ]);
        $select = DB::table('san_phams')->max('id');
        $file = $request->file('image');
        $file_name = $select .'.jpg';
        $file->move(public_path('images'),$file_name);
        DB::update('update san_phams set hinh = ? where id = ?', [$file_name,$select]);
        foreach($request->listNL as $nlId)
        {
           DB::insert('insert into chi_tiet_san_phams (san_pham_id,nguyen_lieu_id,created_at) values (?, ?, ?)', [ $select,$nlId,now()]);
        }
        return redirect()->route('sanpham.adminShow');
       }
       else
       {
        return back()->with('alert','Sản phẩm đã tồn tại!');
       }
       
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SanPham  $sanPham
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $daban = 0;
        $binhchon = 0;
        $so_sao = 0;
        $select = DB::select('select so_sao from danh_gias where  so_sao > 0 and san_pham_id = ?', [$request->id]);
        if(!empty($select))
        {
            foreach($select as $i)
            {
                $so_sao += $i->so_sao;
            }
           
            $binhchon = count($select);
            $so_sao = $so_sao / $binhchon;
        }
        $select = DB::select('select so_luong from chi_tiet_hoa_dons,hoa_dons where hoa_don_id = hoa_dons.id and san_pham_id = ? and trang_thai != "Giỏ Hàng"', [$request->id]);
        if(!empty($select))
        {
            foreach($select as $i)
            {
                $daban += $i->so_luong;
            }
        }
        
        $product = SanPham::join('khuyen_mais','khuyen_mais.id', '=','khuyen_mai_id')
        ->select('san_phams.id','ten_san_pham','mo_ta','gia','hinh','san_phams.trang_thai','tim_kiem','gia_tri')
        ->where('san_phams.id','=',$id)->get();
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
        $comments = DB::table('tai_khoans')
        ->join('binh_luans','binh_luans.tai_khoan_id', '=','tai_khoans.id')
        ->join('danh_gias','danh_gias.tai_khoan_id', '=', 'tai_khoans.id')
        ->where('binh_luans.san_pham_id',$id)
        ->where('danh_gias.san_pham_id',$id)
        ->where('so_sao','>',0)
        ->get();
        //dd($comment);
        $listProduct = DB::select('select san_phams.id,ten_san_pham,gia,hinh,mo_ta, gia_tri from san_phams, khuyen_mais where  san_phams.khuyen_mai_id = khuyen_mais.id and ('.$string.') and san_phams.id <> '.$request->id.' limit 4');
       
        return view('productdetail',['listProduct'=>$listProduct,'product' =>$product,'daban' =>$daban,'so_sao'=>$so_sao,'binhchon'=>$binhchon,'comment'=>$comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SanPham  $sanPham
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sanpham = DB::table('san_phams')
        ->join('loai_san_phams','loai_san_phams.id','=','san_phams.loai_san_pham_id')
        ->join('khuyen_mais','khuyen_mais.id','=','khuyen_mai_id')
        ->select('san_phams.*','loai_san_phams.ten_loai_san_pham','khuyen_mais.gia_tri')
        ->where('san_phams.id',$id)
        ->get();
        $lstKM = DB::table('khuyen_mais')->where('loai_khuyen_mai_id',2)->where('id','<>',$sanpham[0]->khuyen_mai_id)->get();
        $lstloai = DB::table('loai_san_phams')->where('id','<>',$sanpham[0]->loai_san_pham_id)->get();
        $lstNL = DB::table('nguyen_lieus')->where('trang_thai',1)->get();
        $lstDetailProduct = DB::table('chi_tiet_san_phams')->select('nguyen_lieu_id')->where('san_pham_id',$id)->get();
        
        return view('admin.edit.edit_product',['lstKM' => $lstKM,'sanpham'=>$sanpham,'lstloai'=>$lstloai,'lstNL'=>$lstNL,'lstDetailProduct' => $lstDetailProduct]);

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
        $check = DB::table('san_phams')->where('ten_san_pham',$request->tensp)->where('id','<>',$request->id)->get();
        if(count($check)==0)
        {
         $key ='';
         $tim_kiem = explode(',',$request->key);
         for($i = 0; $i < count($tim_kiem); $i++)
         {
             $tim_kiem[$i] = trim($tim_kiem[$i]);
         }
         $key .= implode(', ',$tim_kiem);
         DB::update('update san_phams set ten_san_pham = ?, mo_ta = ?, gia = ?, loai_san_pham_id = ?, khuyen_mai_id = ?, tim_kiem = ? where id = ?',
          [$request->tensp,$request->mota,$request->gia,$request->loaisp,$request->khuyenmai,$key,$request->id]);
         if(!empty($request->file('image')))
         {
            $file = $request->file('image');
            $file_name = $request->id .'.jpg';
            $file->move(public_path('images'),$file_name);
            DB::update('update san_phams set hinh = ? where id = ?', [$file_name,$request->id]);
         }
        $select = DB::table('chi_tiet_san_phams')->where('san_pham_id',$request->id)->get();
        for ($i = 0; $i <count($select);$i++)
        {
           DB::delete('delete from chi_tiet_san_phams where id = ?', [$select[$i]->id]);
        }
        for ($i = 0; $i <count($request->listNL);$i++)
        {
            DB::insert('insert into chi_tiet_san_phams (san_pham_id,nguyen_lieu_id,created_at) values (?, ?, ?)', [ $request->id,$request->listNL[$i],now()]);
         }
         return redirect()->route('sanpham.adminShow');
        }
        else
        {
         return back()->with('alert','Sản phẩm đã tồn tại!');
        }
    }
    public function detail($id)
    {
        $sanpham = DB::table('san_phams')
        ->join('loai_san_phams','loai_san_phams.id','=','san_phams.loai_san_pham_id')
        ->join('khuyen_mais','khuyen_mais.id','=','khuyen_mai_id')
        ->select('san_phams.*','loai_san_phams.ten_loai_san_pham','khuyen_mais.gia_tri')
        ->where('san_phams.id',$id)
        ->get();
        $lstDetailProduct = DB::table('chi_tiet_san_phams')
        ->join('nguyen_lieus','nguyen_lieus.id','=','nguyen_lieu_id')
        ->select('ten_nguyen_lieu')
        ->where('san_pham_id',$id)->get();
        $array = [];
        foreach($lstDetailProduct as $item)
        {
           $array[] = $item->ten_nguyen_lieu;
        }
        $key = implode(', ',$array);
        return view('admin.pages.detail_product',['sanpham'=>$sanpham,'lstDetailProduct'=>$key]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SanPham  $sanPham
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::update('update san_phams set trang_thai = -1 where id = ?', [$request->id]);
       return back();
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $sanphams = DB::table('san_phams')->where('trang_thai', '=',1) ->where('ten_san_pham', 'LIKE', '%' . $request->keyword . '%')->get();
           
            if (!empty($sanphams)) {
                foreach ($sanphams as $item) {
                    $output .= ' <div class="card float-left m-1 h-75" style="width:200px" style="float: left;">
                    <img class="card-img-top" height="200" src=" '.asset("images/$item->hinh").'" alt="Card image">
                    <div class="card-body">
                      <h4 class="card-title">'.$item->ten_san_pham.'</h4><br><br><br>
                      <div>
                        <a href="'.route('sanpham.detail', ['id' => $item->id]).'" class="btn btn-primary">Chi tiết</a>
                        <a href="'. route('sanpham.destroy',['id'=>$item->id]) .'" class="btn btn-danger">Xóa</a>
                        <a href="'.route('sanpham.edit',['id'=>$item->id]).'"><i class="fas fa-wrench"></i></a>
                      </div>
                      </div>
                    
                  </div>';
                }
            }
            else
            {
                $output ='<p>Không có sản phẩm này</p>';
            }

            return response()->json($output);
        }
    }
}
