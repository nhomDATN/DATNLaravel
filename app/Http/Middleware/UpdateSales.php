<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class UpdateSales
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $nothing = DB::table('khuyen_mais')->where('gia_tri',0)->get();
        $sale = DB::table('khuyen_mais')->get();
        foreach ($sale as $key)
        {
            if($key->ngay_ket_thuc < $now)
            {
                DB::update('update khuyen_mais set trang_thai = 0 where id = ?', [$key->id]);
                DB::update('update san_phams set khuyen_mai_id = ? where khuyen_mai_id = ?', [$nothing[0]->id,$key->id]);
            }
        }
        return $next($request);
    }
}
