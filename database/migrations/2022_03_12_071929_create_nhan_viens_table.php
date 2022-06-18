<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNhanViensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhan_viens', function (Blueprint $table) {
            $table->id();
            $table->string('ten_nhan_vien');
            $table->string('dia_chi');
            $table->dateTime('ngay_sinh');
            $table->string('sdt');
            $table->string('CCCD');
            $table->float('luong');
            $table->float('thuong_thang');
            $table->unsignedBigInteger('noi_lam_id');
            $table->unsignedBigInteger('chuc_vu_id');
            $table->integer('trang_thai');
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
        Schema::dropIfExists('nhan_viens');
    }
}
