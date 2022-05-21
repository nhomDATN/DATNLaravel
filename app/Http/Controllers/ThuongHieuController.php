<?php

namespace App\Http\Controllers;

use App\Models\ThuongHieu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use SebastianBergmann\Environment\Console;

class ThuongHieuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lstth = ThuongHieu::all();
        if ($request->has('view_deleted')) {
            $lstth = ThuongHieu::onlyTrashed()->get();
        }
        return view('pages.brand', ['lstth' => $lstth]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add.add_brand');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreThuongHieuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $thuonghieuformat=trim( $request->input('tenthuonghieu')); 
        $tontai=ThuongHieu::where('ten_thuong_hieu','like',$thuonghieuformat)->first(); 
        if(empty($tontai)){
            $kt_thuonghieu=str_replace(' ', '', $thuonghieuformat);
            $tontai=ThuongHieu::where('ten_thuong_hieu','like',$kt_thuonghieu)->first();
            if(empty($tontai))
            {
                $thuongHieu = new ThuongHieu;
                $thuongHieu->fill([
                    'ten_thuong_hieu' => $thuonghieuformat,
                ]);
                $thuongHieu->save();
                return Redirect::route('thuongHieu.index');
            }
        }
        $alert = 'Brand name already in use';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ThuongHieu  $thuongHieu
     * @return \Illuminate\Http\Response
     */
    public function show(ThuongHieu $thuongHieu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ThuongHieu  $thuongHieu
     * @return \Illuminate\Http\Response
     */
    public function edit(ThuongHieu $thuongHieu)
    {
        return view('edit.edit_brand', ['thuongHieu' => $thuongHieu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateThuongHieuRequest  $request
     * @param  \App\Models\ThuongHieu  $thuongHieu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ThuongHieu $thuongHieu)
    {
        $thuonghieuformat=trim( $request->input('tenthuonghieu')); 
        $tontai=ThuongHieu::where('ten_thuong_hieu','like',$thuonghieuformat)->first(); 
        if(empty($tontai)){
            $kt_thuonghieu=str_replace(' ', '', $thuonghieuformat);
            $tontai=ThuongHieu::where('ten_thuong_hieu','like',$kt_thuonghieu)->first();
            if(empty($tontai))
            {
                $thuongHieu->fill([
                    'ten_thuong_hieu' => $thuonghieuformat,
                ]);
                $thuongHieu->save();
                return Redirect::route('thuongHieu.index');
            }
        }
        $alert = 'Brand name already in use';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ThuongHieu  $thuongHieu
     * @return \Illuminate\Http\Response
     */
    public function destroy(ThuongHieu $thuongHieu)
    {
        $thuongHieu->delete();
        return Redirect::route('thuongHieu.index');
    }

    public function restore($id)
    {
        ThuongHieu::withTrashed()->find($id)->restore();

        return back();
    }

    public function restoreAll()
    {
        ThuongHieu::onlyTrashed()->restore();

        return back();
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $brands = ThuongHieu::where('ten_thuong_hieu', 'LIKE', '%' . $request->search . '%')->get();
            if ($brands) {
                foreach ($brands as $key => $th) {
                    $output .= '<tr>
                    <td>' . $th->id . '</td>
                    <td>' . $th->ten_thuong_hieu . '</td>
                    <td>' . $th->created_at . '</td>
                    <td>' . $th->updated_at . '</td>
                    <td style=";width: 20px;">
                        <a href="' . route('thuongHieu.edit', ['thuongHieu' => $th]) . '">
                            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fas fa-edit"></i></button>
                        </a>
                    </td>
                    <td style="width: 20px;">
                        <form method="post" action="' . route('thuongHieu.destroy', ['thuongHieu' => $th]) . '">
                        ' . @csrf_field() . '
                        ' . @method_field("DELETE") . '
                            <button type="submit" class="btn btn-default btn-sm checkbox-toggle"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                    </tr>';
                }
            }

            return Response($output);
        }
    }

    public function searchThuongHieuXoa(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $brands = ThuongHieu::where('ten_thuong_hieu', 'LIKE', '%' . $request->search . '%')->onlyTrashed()->get();
            if ($brands) {
                foreach ($brands as $key => $th) {
                    $output .= '<tr>
                    <td>' . $th->id . '</td>
                    <td>' . $th->ten_thuong_hieu . '</td>
                    <td>' . $th->created_at . '</td>
                    <td>' . $th->updated_at . '</td>
                    <td>' . $th->deleted_at . '</td>
                    <td style=";width: 20px;">
                     <a href="' . route('thuongHieu.restore', $th->id) . '">
                     <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fas fa-redo"></i></button>
                     </a>
                     </td>
                    </tr>';
                }
            }

            return Response($output);
        }
    }
}
