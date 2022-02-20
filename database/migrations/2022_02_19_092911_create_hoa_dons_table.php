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
            $table->string('nguoi_nhan_hang');
            $table->string('dia_chi_nguoi_nhan_hang');
            $table->string('sdt_nguoi_nhan_hang');
            $table->string('trang_thai');
            $table->unsignedBigInteger('tai_khoan_id');
            $table->unsignedBigInteger('tai_khoan_nhan_vien_id');
            $table->timestamps();
            $table->softDeletes();
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
