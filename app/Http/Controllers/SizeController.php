<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lstsize=Size::all();
        if ($request->has('view_deleted')) {
            $lstsize = Size::onlyTrashed()->get();
        }  
        return view('pages.size',['lstsize'=>$lstsize]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add.add_size');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSizeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sizeformat=trim( $request->input('tensize')); 
        $tontai=Size::where('ten_size','like', $sizeformat)->first(); 
        if(empty($tontai)){
            $kt_size = str_replace(' ', '', $sizeformat);
            $tontai = Size::where('ten_size', 'like', $kt_size)->first();
            if(empty($tontai))
            {
                $size = new Size;
                $size->fill([
                    'ten_size' => $sizeformat,
                ]);
                $size->save();
                return Redirect::route('size.index');
            }
        }
        $alert = 'Size name already in use';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        return view('edit.edit_size',['size'=>$size]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSizeRequest  $request
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Size $size)
    {
        $sizeformat=trim( $request->input('tensize')); 
        $tontai=Size::where('ten_size','like', $sizeformat)->first(); 
        if(empty($tontai)){
            $kt_size = str_replace(' ', '', $sizeformat);
            $tontai = Size::where('ten_size', 'like', $kt_size)->first();
            if(empty($tontai))
            {
                $size->fill([
                    'ten_size' => $sizeformat,
                ]);
                $size->save();
                return Redirect::route('size.index');
            }
        }
        $alert = 'Size name already in use';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        $size->delete();
        return Redirect::route('size.index');
    }

    public function restore($id)
    {
        Size::withTrashed()->find($id)->restore();
  
        return back();
    }  
  
    public function restoreAll()
    {
        Size::onlyTrashed()->restore();
  
        return back();
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $sizes = Size::where('ten_size', 'LIKE', '%' . $request->search . '%')
            ->get();
            if ($sizes) {
                foreach ($sizes as $key => $size) {
                    $output .= '<tr>
                    <td>' . $size->id . '</td>
                    <td>' . $size->ten_size . '</td>
                    <td>' . $size->created_at . '</td>
                    <td>' . $size->updated_at . '</td>
                    <td style=";width: 20px;">
                     <a href="'.route('size.edit', ['size' => $size]).'">
                     <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fas fa-edit"></i></button>
                     </a>
                     </td>
                     <td style="width: 20px;">
                     <form method="post" action="'.route('size.destroy', ['size' => $size]).'">
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

    public function searchSizeXoa(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $sizes = Size::where('ten_size', 'LIKE', '%' . $request->search . '%')
            ->onlyTrashed()
            ->get();
            if ($sizes) {
                foreach ($sizes as $key => $size) {
                    $output .= '<tr>
                    <td>' . $size->id . '</td>
                    <td>' . $size->ten_size . '</td>
                    <td>' . $size->created_at . '</td>
                    <td>' . $size->updated_at . '</td>
                    <td>' . $size->deleted_at . '</td>
                    <td style=";width: 20px;">
                     <a href="'.route('size.restore', $size->id).'">
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
