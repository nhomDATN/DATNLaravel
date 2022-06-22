<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoaDonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoa_dons', function (Blueprint $table) {
            $table->id();
            $table->string('voucher');
            $table->string('nguoi_nhan_hang');
            $table->string('dia_chi_nguoi_nhan_hang');
            $table->string('sdt_nguoi_nhan_hang');
            $table->float('tong_tien');
            $table->unsignedBigInteger('tai_khoan_id');
            $table->unsignedBigInteger('nhan_vien_id');
            $table->integer('trang_thai');
            $table->string('phuong_thuc_thanh_toan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hoa_dons');
    }
}
