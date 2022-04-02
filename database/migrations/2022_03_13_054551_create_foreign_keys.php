<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignkeys extends Migration
{
    /**
     * Run the migrations.
     *

     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('san_phams', function (Blueprint $table) {
            $table->foreign('loai_san_pham_id')->references('id')->on('loai_san_phams');
            $table->foreign('khuyen_mai_id')->references('id')->on('khuyen_mais');
        });
        Schema::table('tai_khoans', function (Blueprint $table) {
            $table->foreign('loai_tai_khoan_id')->references('id')->on('loai_tai_khoans');
        });
        Schema::table('hoa_dons', function (Blueprint $table) {
            $table->foreign('tai_khoan_id')->references('id')->on('tai_khoans');
            $table->foreign('nhan_vien_id')->references('id')->on('nhan_viens');
        });
        Schema::table('chi_tiet_hoa_dons', function (Blueprint $table) {
            $table->foreign('hoa_don_id')->references('id')->on('hoa_dons');
            $table->foreign('san_pham_id')->references('id')->on('san_phams');
        });
       
        Schema::table('binh_luans', function (Blueprint $table) {
            $table->foreign('tai_khoan_id')->references('id')->on('tai_khoans');
            $table->foreign('san_pham_id')->references('id')->on('san_phams');
        });
        Schema::table('danh_gias', function (Blueprint $table) {
            $table->foreign('tai_khoan_id')->references('id')->on('tai_khoans');
            $table->foreign('san_pham_id')->references('id')->on('san_phams');
        });
        Schema::table('khuyen_mais', function (Blueprint $table) {
            $table->foreign('loai_khuyen_mai_id')->references('id')->on('loai_khuyen_mais');  
        });
       
        Schema::table('nguyen_lieus', function (Blueprint $table) {
            $table->foreign('don_vi_tinh_id')->references('id')->on('don_vi_tinhs');
            $table->foreign('kho_id')->references('id')->on('noi_lam_viecs');
            
        });
        Schema::table('chi_tiet_san_phams', function (Blueprint $table) {
            $table->foreign('san_pham_id')->references('id')->on('san_phams');
            $table->foreign('nguyen_lieu_id')->references('id')->on('nguyen_lieus');
        });
        Schema::table('nhan_viens', function (Blueprint $table) {
            //$table->foreign('noi_lam')->references('ma_noi_lam_viec')->on('noi_lam_viecs');
            //$table->foreign('noi_lam')->references('ma_kho')->on('khos');
            $table->foreign('noi_lam_id')->references('id')->on('noi_lam_viecs');
            $table->foreign('chuc_vu_id')->references('id')->on('chuc_vus');
        });
        Schema::table('phan_phois', function (Blueprint $table) {
            $table->foreign('noi_phan_phoi_id')->references('id')->on('noi_lam_viecs');
            $table->foreign('nguyen_lieu_id')->references('id')->on('nguyen_lieus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('san_phams', function (Blueprint $table) {
        });
        Schema::table('tai_khoans', function (Blueprint $table) {
        });
        Schema::table('hoa_dons', function (Blueprint $table) {
        });
        Schema::table('chi_tiet_hoa_dons', function (Blueprint $table) {
        });
     
        Schema::table('danh_gias', function (Blueprint $table) {
        });
        Schema::table('binh_luans', function (Blueprint $table) {
        });
        Schema::table('khuyen_mais', function (Blueprint $table) {
        });
        
        Schema::table('nguyen_lieus', function (Blueprint $table) {
        });
        Schema::table('chi_tiet_san_phams', function (Blueprint $table) {
        });
        Schema::table('nhan_viens', function (Blueprint $table) {
        });
        Schema::table('phan_phois', function (Blueprint $table) {
        });
    }
}


