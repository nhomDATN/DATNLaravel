<?php

namespace App\Http\Controllers;

use App\Models\DonViTinh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class DonViTinhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstdvt = DonViTinh::all();
        return view('admin/pages.computing_unit', ['lstdvt' => $lstdvt]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/add.add_computing_unit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDonViTinhRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->input('tendonvitinh') == null) {
            $alert = 'Tên đơn vị tính không được bỏ trống';
            return redirect()->back()->with('alert', $alert);
        }

        $tonTai = DonViTinh::where('ten_don_vi_tinh', $request['tendonvitinh'])->first();
        if (empty($tonTai)) {
            $loaiKhuyenMai = DonViTinh::insert([
                'ten_don_vi_tinh' => $request->input('tendonvitinh'),
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => null,
            ]);
            return Redirect::route('donViTinh.index');
        }
        $alert = 'Tên đơn vị tính đã tồn tại';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DonViTinh  $DonViTinh
     * @return \Illuminate\Http\Response
     */
    public function show(DonViTinh $donViTinh)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DonViTinh  $donViTinh
     * @return \Illuminate\Http\Response
     */
    public function edit(DonViTinh $donViTinh)
    {
        return view('admin/edit.edit_computing_unit', ['donViTinh' => $donViTinh]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDonViTinhRequest  $request
     * @param  \App\Models\DonViTinh  $donViTinh
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DonViTinh $donViTinh)
    {
        $donvitinhformat = trim( $request->input('tendonvitinh')); 
        $tontai = DonViTinh::where('ten_don_vi_tinh','like', $donvitinhformat)
        ->where('don_vi_tinhs.id', '!=', $donViTinh->id)
        ->first();
       
        if(empty($tontai)){
            $donViTinh->fill([
                'ten_don_vi_tinh' => $donvitinhformat,
                'trang_thai' => $request->input('trangthai'),
            ]);
            $donViTinh->save();
            return Redirect::route('donViTinh.index'); 
        }
        $alert = 'Tên đơn vị tính đã tồn tại';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DonViTinh  $donViTinh
     * @return \Illuminate\Http\Response
     */
    public function destroy(DonViTinh $donViTinh)
    {
        $donViTinh->fill([
            'trang_thai' => 0,
        ]);
        $donViTinh->save();
        return Redirect::route('donViTinh.index');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $computing_unit = DonViTinh::where('ten_don_vi_tinh', 'LIKE', '%' . $request->search . '%')
            ->get();
            
            $stt = 0;

            if ($computing_unit) {
                foreach ($computing_unit as $key => $dvt) {
                    $output .= '<tr>
                        <td>' . ++$stt . '</td>
                        <td>' . $dvt->ten_don_vi_tinh . '</td>';
                        if($dvt->trang_thai == 1) {
                            $output .= '<td>Hoạt Động</td>';
                        }
                        else {
                            $output .= '<td>Ngưng Hoạt Động</td>';
                        } 
                        
                        $output .= '
                        <td>' . $dvt->created_at . '</td>
                        <td>' . $dvt->updated_at . '</td>
                        <td style=";width: 20px;">
                            <a href="'.route('donViTinh.edit', ['donViTinh' => $dvt]).'">
                                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fas fa-edit"></i></button>
                            </a>
                        </td>
                        <td style="width: 20px;">
                            <form method="post" action="'.route('donViTinh.destroy', ['donViTinh' => $dvt]).'">
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

}
