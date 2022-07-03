<?php

namespace App\Http\Controllers;

use App\Models\DonViTinh;
use App\Models\PhanPhoi;

use App\Models\NguyenLieu;
use App\Models\NoiLamViec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PhanPhoiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstphanphoi = DB::select('SELECT phan_phois.id, a.ma_noi_lam_viec as ma_noi_lam_viec, nguyen_lieus.ten_nguyen_lieu, don_vi_tinhs.ten_don_vi_tinh, b.ma_noi_lam_viec as kho_id, phan_phois.so_luong, phan_phois.created_at
        FROM `phan_phois`, `noi_lam_viecs` a, `noi_lam_viecs` b, `nguyen_lieus`, `don_vi_tinhs`
        WHERE phan_phois.noi_phan_phoi_id = a.id and phan_phois.kho_id = b.id  and phan_phois.nguyen_lieu_id = nguyen_lieus.id and don_vi_tinhs.id = phan_phois.don_vi_tinh_id');
        // dd($lstphanphoi);
        return view('admin/pages.distribution', ['lstphanphoi' => $lstphanphoi]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lstnlv = NoiLamViec::where('noi_lam_viecs.ma_noi_lam_viec', 'like', 'CH-%')->get();

        $lstkho = NoiLamViec::join('nguyen_lieus', 'nguyen_lieus.kho_id', '=', 'noi_lam_viecs.id')
        ->where('noi_lam_viecs.ma_noi_lam_viec', 'like', 'K-%')
        ->select('noi_lam_viecs.id', 'noi_lam_viecs.ma_noi_lam_viec')
        ->groupBy('noi_lam_viecs.ma_noi_lam_viec', 'noi_lam_viecs.id')
        ->get();

        $lstdvt = DonViTinh::all();

        $lstnguyenlieu = NguyenLieu::all();

        return view('admin/add.add_distribution', ['lstnlv' => $lstnlv, 'lstkho' => $lstkho,'lstdvt' => $lstdvt, 'lstnguyenlieu' => $lstnguyenlieu]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePhanPhoiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tontai = PhanPhoi::where('noi_phan_phoi_id','like', $request->input('noiphanphoi'))
        ->where('nguyen_lieu_id','=', $request->input('tennguyenlieu'))
        ->where('kho_id', '=',  $request->input('kho'))
        ->first();
        

        if (empty($tontai)) {
            $nguyenlieu = NguyenLieu::where('id', '=', $request->input('tennguyenlieu'))
            ->where('kho_id', '=', $request->input('kho'))
            ->first();

            if ($nguyenlieu->so_luong >= $request->input('soluong')) {
                $phanPhoi = PhanPhoi::insert([
                    'noi_phan_phoi_id' => $request->input('noiphanphoi'),
                    'nguyen_lieu_id' => $request->input('tennguyenlieu'),
                    'kho_id' => $request->input('kho'),
                    'don_vi_tinh_id' => $request->input('donvitinh'),
                    'so_luong' => $request->input('soluong'),
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                    'updated_at' => null,
                ]);

                $nguyenlieu =  DB::update('update nguyen_lieus 
                    set so_luong = ?
                    where id = ? and kho_id = ? ',
                    [$nguyenlieu->so_luong - $request->input('soluong'), $request->input('tennguyenlieu'), $request->input('kho')]
                );

                return Redirect::route('phanPhoi.index'); 
            }
           
            else {
                $alert = 'Số lượng trong kho không đủ để phân phối.';
                return redirect()->back()->with('alert', $alert);
            }
        }
        $alert = 'Nơi phân phối đã tồn tại nguyên liệu này.';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PhanPhoi  $phanPhoi
     * @return \Illuminate\Http\Response
     */
    public function show(PhanPhoi $phanPhoi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PhanPhoi  $phanPhoi
     * @return \Illuminate\Http\Response
     */
    public function edit(PhanPhoi  $phanPhoi)
    {
        $lstnlv = NoiLamViec::where('noi_lam_viecs.ma_noi_lam_viec', 'like', 'CH-%')->get();

        $lstkho = NoiLamViec::join('nguyen_lieus', 'nguyen_lieus.kho_id', '=', 'noi_lam_viecs.id')
        ->where('noi_lam_viecs.ma_noi_lam_viec', 'like', 'K-%')
        ->select('noi_lam_viecs.id', 'noi_lam_viecs.ma_noi_lam_viec')
        ->groupBy('noi_lam_viecs.ma_noi_lam_viec', 'noi_lam_viecs.id')
        ->get();

        $lstdvt = DonViTinh::all();

        $lstnguyenlieu = NguyenLieu::all();

        return view('admin/edit.edit_distribution', ['phanPhoi' => $phanPhoi, 'lstnlv' => $lstnlv, 'lstdvt' => $lstdvt,'lstnguyenlieu' => $lstnguyenlieu, 'lstkho' => $lstkho]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePhanPhoiRequest  $request
     * @param  \App\Models\PhanPhoi  $phanPhoi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PhanPhoi $phanPhoi)
    {
        $phanphoiformat = $request->input('noiphanphoi');
        $nguyenlieuformat =  $request->input('tennguyenlieu');
        $khoformat = $request->input('kho');
        $tontai = PhanPhoi::where('noi_phan_phoi_id', '=', $phanphoiformat)
        ->where('nguyen_lieu_id', '=', $nguyenlieuformat)
        ->where('kho_id', '=', $khoformat)
        ->where('phan_phois.id', '!=', $phanPhoi->id)
        ->first();

        if(empty($tontai)){
            $phanPhoi = DB::update('update phan_phois 
                set noi_phan_phoi_id = ?, nguyen_lieu_id =?, kho_id = ?, so_luong =?
                where id = ? ', 
                [$request->input('noiphanphoi'), $request->input('tennguyenlieu'), $request->input('kho'), $request->input('soluong'), $phanPhoi->id]
            );
            return Redirect::route('phanPhoi.index');
        }
        $alert = 'Nơi phân phối đã tồn tại nguyên liệu này.';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PhanPhoi  $phanPhoi
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhanPhoi $phanPhoi)
    {
        $phanPhoi->delete();
        return Redirect::route('phanPhoi.index');
    }

    public function search(Request $request)
    {
       
        $output = '';
        $distributions = DB::select('SELECT phan_phois.id, a.ma_noi_lam_viec as ma_noi_lam_viec, nguyen_lieus.ten_nguyen_lieu, don_vi_tinhs.ten_don_vi_tinh, b.ma_noi_lam_viec as kho_id, phan_phois.so_luong, phan_phois.created_at
        FROM `phan_phois`, `noi_lam_viecs` a, `noi_lam_viecs` b, `nguyen_lieus`, `don_vi_tinhs`
        WHERE phan_phois.noi_phan_phoi_id = a.id and phan_phois.kho_id = b.id  
        and phan_phois.nguyen_lieu_id = nguyen_lieus.id 
        and don_vi_tinhs.id = phan_phois.don_vi_tinh_id 
        and nguyen_lieus.ten_nguyen_lieu LIKE "%'. $request->search . '%"');
        
        $stt = 0;

        if ($distributions) {
            foreach ($distributions as $key => $pp) {
                $output .= '<tr>
                    <td>' . ++$stt . '</td>
                    <td>' . $pp->ma_noi_lam_viec . '</td>
                    <td>' . $pp->ten_nguyen_lieu . '</td>
                    <td>' . $pp->ten_don_vi_tinh . '</td>
                    <td>' . $pp->kho_id . '</td>
                    <td>' . $pp->so_luong . '</td>
                    <td>' . $pp->created_at . '</td>
                    <td style=";width: 20px;">
                        <a href="'.route('phanPhoi.edit', ['phanPhoi' => $pp->id]).'">
                            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fas fa-edit"></i></button>
                        </a>
                    </td>
                    <td style="width: 20px;">
                        <form method="post" action="'.route('phanPhoi.destroy', ['phanPhoi' => $pp->id]).'">
                        '.@csrf_field().'
                        '.@method_field("DELETE").'
                            <button type="submit" class="btn btn-default btn-sm checkbox-toggle"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>';
            }
        }

        return Response($output);
    
    }
}
