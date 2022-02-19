<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignkey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('san_phams', function (Blueprint $table) {
            $table->foreign('loai_san_pham_id')->references('id')->on('loai_san_phams');
        });
        Schema::table('tai_khoans', function (Blueprint $table) {
            $table->foreign('loai_tai_khoan_id')->references('id')->on('loai_tai_khoans');
        });
        Schema::table('hoa_dons', function (Blueprint $table) {
            $table->foreign('tai_khoan_nhan_vien_id')->references('id')->on('tai_khoans');
        });
        Schema::table('chi_tiet_hoa_dons', function (Blueprint $table) {
            $table->foreign('hoa_don_id')->references('id')->on('hoa_dons');
        });
        Schema::table('yeu_thiches', function (Blueprint $table) {
            $table->foreign('tai_khoan_id')->references('id')->on('tai_khoans');
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
        Schema::table('kho_nguyen_lieus', function (Blueprint $table) {
            $table->foreign('nha_cung_cap_id')->references('id')->on('nha_cung_caps');  
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
        Schema::table('yeu_thiches', function (Blueprint $table) {
        });
        Schema::table('danh_gias', function (Blueprint $table) {
        });
        Schema::table('binh_luans', function (Blueprint $table) {
        });
        Schema::table('kho_nguyen_lieus', function (Blueprint $table) {
        });
        Schema::table('khuyen_mais', function (Blueprint $table) {
        });
    }
}
