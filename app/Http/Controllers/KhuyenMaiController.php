<?php

namespace App\Http\Controllers;

use App\Models\KhuyenMai;
use App\Models\LoaiKhuyenMai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class KhuyenMaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstkm = KhuyenMai::join('loai_khuyen_mais', 'loai_khuyen_mais.id', '=', 'khuyen_mais.loai_khuyen_mai_id')
        ->select('khuyen_mais.id', 'khuyen_mais.ma_khuyen_mai', 'loai_khuyen_mais.ten_loai_khuyen_mai', 'khuyen_mais.ngay_bat_dau', 'khuyen_mais.ngay_ket_thuc', 'khuyen_mais.gia_tri', 'khuyen_mais.maximum', 'khuyen_mais.trang_thai')
        ->get();
        return view('admin/pages.promotion', ['lstkm' => $lstkm]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lstlkm = LoaiKhuyenMai::all();
        return view('admin/add.add_promotion', ['lstlkm' => $lstlkm]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKhuyenMaiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->input('makhuyenmai') == null) {
            $alert = 'Mã khuyến mãi không được bỏ trống';
            return redirect()->back()->with('alert', $alert);
        }

        else if ($request->ngaybatdau == null) {
            $alert = 'Ngày bắt đầu không được bỏ trống';
            return redirect()->back()->with('alert', $alert);
        }
        else if ($request->input('giatri') == null) {
            $alert = 'Giá trị phần trăm giảm giá không được bỏ trống';
            return redirect()->back()->with('alert', $alert);
        }

        else if ($request->input('maximum') == null) {
            $alert = 'Số tiền được giảm tối đa không được bỏ trống';
            return redirect()->back()->with('alert', $alert);
        }

        $tonTai = KhuyenMai::where('ma_khuyen_mai', $request['makhuyenmai'])->first();
        if (empty($tonTai)) {
            $khuyenMai = KhuyenMai::insert([
                'ma_khuyen_mai' => $request->input('makhuyenmai'),
                'loai_khuyen_mai_id' => $request->input('loaikhuyenmai'),
                'ngay_bat_dau' => $request->ngaybatdau,
                'ngay_ket_thuc' => $request->ngayketthuc,
                'gia_tri' => $request->input('giatri'),
                'maximum' => $request->input('maximum'),
            ]);
            return Redirect::route('khuyenMai.index');
        }
        $alert = 'Mã khuyến mãi đã tồn tại';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KhuyenMai  $khuyenMai
     * @return \Illuminate\Http\Response
     */
    public function show(KhuyenMai $khuyenMai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KhuyenMai  $khuyenMai
     * @return \Illuminate\Http\Response
     */
    public function edit(KhuyenMai $khuyenMai)
    {
        $lstlkm = LoaiKhuyenMai::all();
        return view('admin/edit.edit_promotion', ['khuyenMai' => $khuyenMai, 'lstlkm' => $lstlkm]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKhuyenMaiRequest  $request
     * @param  \App\Models\KhuyenMai  $khuyenMai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KhuyenMai $khuyenMai)
    {
        if ($request->ngaybatdau == null){
            $alert = 'Ngày bắt đầu không được bỏ trống';
            return redirect()->back()->with('alert', $alert);
        }
        if ($request->ngayketthuc == null){
            $alert = 'Ngày kết thúc không được bỏ trống';
            return redirect()->back()->with('alert', $alert);
        }   

        if ($request->ngaybatdau > $request->ngayketthuc) {
            $alert = 'Ngày bắt đầu phải nhỏ hơn ngày kết thúc';
            return redirect()->back()->with('alert', $alert);
        }

        $khuyenmaiformat=trim( $request->input('makhuyenmai')); 
        $tontai = KhuyenMai::where('ma_khuyen_mai','like', $khuyenmaiformat)
        ->where('khuyen_mais.ma_khuyen_mai', '!=', $request->input('makhuyenmai'))
        ->first(); 
        if(empty($tontai)){
            $kt_khuyenmai=str_replace(' ', '', $khuyenmaiformat);
            $tontai = KhuyenMai::where('ma_khuyen_mai','like',$kt_khuyenmai)
            ->where('khuyen_mais.ma_khuyen_mai', '!=', $request->input('makhuyenmai'))
            ->first();
            if(empty($tontai))
            {
                $khuyenMai->fill([
                    'ma_khuyen_mai' => $khuyenmaiformat,
                    'loai_khuyen_mai_id' => $request->input('loaikhuyenmai'),
                    'ngay_bat_dau' => $request->ngaybatdau,
                    'ngay_ket_thuc' => $request->ngayketthuc,
                    'gia_tri' => $request->input('giatri'),
                    'maximum' => $request->input('maximum'),
                    'trang_thai' => $request->input('trangthai'),
                    
                ]);
                $khuyenMai->save();
                return Redirect::route('khuyenMai.index');
            }
        }
        $alert = 'Mã khuyến mãi đã tồn tại';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KhuyenMai  $khuyenMai
     * @return \Illuminate\Http\Response
     */
    public function destroy(KhuyenMai $khuyenMai)
    {
        //
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $promotions = KhuyenMai::join('loai_khuyen_mais', 'loai_khuyen_mais.id', '=', 'khuyen_mais.loai_khuyen_mai_id')
            ->select('khuyen_mais.id', 'khuyen_mais.ma_khuyen_mai', 'loai_khuyen_mais.ten_loai_khuyen_mai', 'khuyen_mais.ngay_bat_dau', 'khuyen_mais.ngay_ket_thuc', 'khuyen_mais.gia_tri', 'khuyen_mais.maximum', 'khuyen_mais.trang_thai')
            ->where('khuyen_mais.ma_khuyen_mai', 'LIKE', '%' . $request->search . '%')
            ->get();
            
            $stt = 0;

            if ($promotions) {
                foreach ($promotions as $key => $km) {
                    $output .= '<tr>
                        <td>' . ++$stt . '</td>
                        <td>' . $km->ma_khuyen_mai . '</td>
                        <td>' . $km->ten_loai_khuyen_mai . '</td>
                        <td>' . $km->ngay_bat_dau . '</td>
                        <td>' . $km->ngay_ket_thuc . '</td>
                        <td>' . $km->gia_tri . '</td>
                        <td>' . $km->maximum . '</td>';
                        if($km->trang_thai == 1) {
                            $output .= '<td>Hoạt Động</td>';
                        }
                        else {
                            $output .= '<td>Ngưng Hoạt Động</td>';
                        } 
                        
                        $output .= '
                        <td style=";width: 20px;">
                            <a href="'.route('khuyenMai.edit', ['khuyenMai' => $km]).'">
                                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fas fa-edit"></i></button>
                            </a>
                        </td>
                    </tr>';
                }
            }

            return Response($output);
        }
    }
}
