<?php

namespace App\Http\Controllers;

use App\Models\ChucVu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class ChucVuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstcv = ChucVu::all();
        return view('admin/pages.position', ['lstcv' => $lstcv]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/add.add_position');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreChucVuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tonTai = ChucVu::where('ten_chuc_vu', $request['tenchucvu'])->first();
        if (empty($tonTai)) {
            $chucVu = ChucVu::insert([
                'ten_chuc_vu' => $request->input('tenchucvu'),
                'thuong' => $request->input('thuong'),
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => null,
            ]);
            return Redirect::route('chucVu.index');
        }
        $alert = 'Tên chức vụ đã tồn tại';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChucVu  $chucVu
     * @return \Illuminate\Http\Response
     */
    public function show(ChucVu $chucVu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChucVu  $chucVu
     * @return \Illuminate\Http\Response
     */
    public function edit(ChucVu $chucVu)
    {
        return view('admin/edit.edit_position', ['chucVu' => $chucVu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChucVuRequest  $request
     * @param  \App\Models\ChucVu  $chucVu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChucVu $chucVu)
    {
        $chucvuformat = trim( $request->input('tenchucvu')); 
        $tontai = ChucVu::where('ten_chuc_vu','like', $chucvuformat)
        ->where('chuc_vus.id', '!=', $chucVu->id)
        ->first();

        if(empty($tontai)){
            $chucVu->fill([
                'ten_chuc_vu' => $chucvuformat,
                'thuong' => $request->input('thuong'),
            ]);
            $chucVu->save();
            return Redirect::route('chucVu.index');
        }
        $alert = 'Tên chức vụ đã tồn tại';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChucVu  $chucVu
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChucVu $chucVu)
    {
        //
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $positions = ChucVu::where('ten_chuc_vu', 'LIKE', '%' . $request->search . '%')
            ->get();
            
            $stt =0; 

            if ($positions) {
                foreach ($positions as $key => $cv) {
                    $output .= '<tr>
                        <td>' . ++$stt . '</td>
                        <td>' . $cv->ten_chuc_vu . '</td>
                        <td>' . $cv->thuong . '</td>
                        <td>' . $cv->created_at . '</td>
                        <td>' . $cv->updated_at . '</td>
                        <td style=";width: 20px;">
                            <a href="'.route('chucVu.edit', ['chucVu' => $cv]).'">
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
