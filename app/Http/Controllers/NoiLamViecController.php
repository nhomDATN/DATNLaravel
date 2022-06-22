<?php

namespace App\Http\Controllers;

use App\Models\NoiLamViec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class NoiLamViecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstnoilamviec = NoiLamViec::all();
        return view('admin/pages.workplace', ['lstnoilamviec' => $lstnoilamviec]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin/add.add_workplace');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCuaHangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->input('manoilamviec') == null) {
            $alert = 'Mã nơi làm việc không được bỏ trống';
            return redirect()->back()->with('alert', $alert);
        }

        if ($request->input('diachi') == null) {
            $alert = 'Địa chỉ nơi làm việc không được bỏ trống';
            return redirect()->back()->with('alert', $alert);
        }

        $tonTai = NoiLamViec::where('ma_noi_lam_viec', $request['manoilamviec'])->first();
        if (empty($tonTai)) {
            $noiLamViec = NoiLamViec::insert([
                'ma_noi_lam_viec' => $request->input('manoilamviec'),
                'dia_chi' => $request->input('diachi'),
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => null,
            ]);
            return Redirect::route('noiLamViec.index');
        }
        $alert = 'Mã nơi làm việc đã tồn tại';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CuaHang  $cuaHang
     * @return \Illuminate\Http\Response
     */
    public function show(NoiLamViec $noiLamViec)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CuaHang  $cuaHang
     * @return \Illuminate\Http\Response
     */
    public function edit(NoiLamViec $noiLamViec)
    {
        return view('admin/edit.edit_workplace', ['noiLamViec' => $noiLamViec]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCuaHangRequest  $request
     * @param  \App\Models\CuaHang  $cuaHang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NoiLamViec $noiLamViec)
    {
        $noilamviecformat = trim( $request->input('manoilamviec')); 
        $tontai = NoiLamViec::where('ma_noi_lam_viec','like', $noilamviecformat)
        ->where('id', '!=', $noiLamViec->id)
        ->first();
        if(empty($tontai)){
            $kt_noilamviec = str_replace(' ', '', $noilamviecformat);
            $tontai = NoiLamViec::where('ma_noi_lam_viec','like',$kt_noilamviec)
            ->where('id', '!=', $noiLamViec->id)
            ->first();
            if(empty($tontai)){
                $noiLamViec->fill([
                    'ma_noi_lam_viec' => $noilamviecformat,
                    'dia_chi' => $request->input('diachi'),
                    'trang_thai'  => $request->input('trangthai'),
                ]);
                $noiLamViec->save();
                return Redirect::route('noiLamViec.index');
            }
        }
        $alert = 'Mã nơi làm việc đã tồn tại';
        return redirect()->back()->with('alert', $alert);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CuaHang  $cuaHang
     * @return \Illuminate\Http\Response
     */
    public function destroy(NoiLamViec $noiLamViec)
    {
        $noiLamViec->fill([
            'trang_thai' => 0,
        ]);
        $noiLamViec->save();
        return Redirect::route('noiLamViec.index');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $workplaces = NoiLamViec::where('ma_noi_lam_viec', 'LIKE', '%' . $request->search . '%')
            ->get();
            
            $stt = 0;
            if ($workplaces) {
                foreach ($workplaces as $key => $nlv) {
                    $output .= '<tr>
                        <td>' . ++$stt . '</td>
                        <td>' . $nlv->ma_noi_lam_viec . '</td>
                        <td>' . $nlv->dia_chi . '</td>';
                        if($nlv->trang_thai == 1) {
                            $output .= '<td>Hoạt Động</td>';
                        }
                        else {
                            $output .= '<td>Ngưng Hoạt Động</td>';
                        } 
                        
                        $output .= '
                        <td>' . $nlv->created_at . '</td>
                        <td>' . $nlv->updated_at . '</td>
                        <td style=";width: 20px;">
                            <a href="'.route('noiLamViec.edit', ['noiLamViec' => $nlv]).'">
                                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fas fa-edit"></i></button>
                            </a>
                        </td>
                        <td style="width: 20px;">
                            <form method="post" action="'.route('noiLamViec.destroy', ['noiLamViec' => $nlv]).'">
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
