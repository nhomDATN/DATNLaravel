<?php

namespace App\Http\Controllers;

use App\Models\Mau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MauController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lstmau = Mau::all();
        if ($request->has('view_deleted')) {
            $lstmau = Mau::onlyTrashed()->get();
        }  
        return view('pages.color', ['lstmau' => $lstmau]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add.add_color');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMauRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mauformat=trim( $request->input('tenmau')); 
        $tontai=Mau::where('ten_mau','like',$mauformat)->first(); 
        if(empty($tontai)){
            $kt_mau=str_replace(' ', '', $mauformat);
            $tontai=Mau::where('ten_mau','like',$kt_mau)->first();
            if(empty($tontai))
            {
                $mau = new Mau;
                $mau->fill([
                    'ten_mau' => $mauformat,
                ]);
                $mau->save();
                return Redirect::route('mau.index');
            }
        }
        $alert = 'Color name already in use';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mau  $mau
     * @return \Illuminate\Http\Response
     */
    public function show(Mau $mau)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mau  $mau
     * @return \Illuminate\Http\Response
     */
    public function edit(Mau $mau)
    {
        return view('edit.edit_color',['mau'=>$mau]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMauRequest  $request
     * @param  \App\Models\Mau  $mau
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mau $mau)
    {
        $mauformat=trim( $request->input('tenmau')); 
        $tontai=Mau::where('ten_mau','like',$mauformat)->first(); 
        if(empty($tontai)){
            $kt_mau=str_replace(' ', '', $mauformat);
            $tontai=Mau::where('ten_mau','like',$kt_mau)->first();
            if(empty($tontai))
            {
                $mau->fill([
                    'ten_mau' => $mauformat,
                ]);
                $mau->save();
                return Redirect::route('mau.index');
            }
        }
        $alert = 'Color name already in use';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mau  $mau
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mau $mau)
    {
        $mau->delete();
        return Redirect::route('mau.index');
    }

    public function restore($id)
    {
        Mau::withTrashed()->find($id)->restore();
  
        return back();
    }  
  
    public function restoreAll()
    {
        Mau::onlyTrashed()->restore();
  
        return back();
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $maus = Mau::where('ten_mau', 'LIKE', '%' . $request->search . '%')
            ->get();
            if ($maus) {
                foreach ($maus as $key => $mau) {
                    $output .= '<tr>
                    <td>' . $mau->id . '</td>
                    <td>' . $mau->ten_mau . '</td>
                    <td>' . $mau->created_at . '</td>
                    <td>' . $mau->updated_at . '</td>
                    <td style=";width: 20px;">
                     <a href="'.route('mau.edit', ['mau' => $mau]).'">
                     <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fas fa-edit"></i></button>
                     </a>
                     </td>
                     <td style="width: 20px;">
                     <form method="post" action="'.route('mau.destroy', ['mau' => $mau]).'">
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

    public function searchMauXoa(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $maus = Mau::where('ten_mau', 'LIKE', '%' . $request->search . '%')
            ->onlyTrashed()
            ->get();
            if ($maus) {
                foreach ($maus as $key => $mau) {
                    $output .= '<tr>
                    <td>' . $mau->id . '</td>
                    <td>' . $mau->ten_mau . '</td>
                    <td>' . $mau->created_at . '</td>
                    <td>' . $mau->updated_at . '</td>
                    <td>' . $mau->deleted_at . '</td>
                    <td style=";width: 20px;">
                     <a href="'.route('mau.restore', $mau->id).'">
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
