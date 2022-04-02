<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaiKhoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tai_khoans', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('mat_khau');
            $table->string('dia_chi');
            $table->string('ngay_sinh');
            $table->string('sdt');
            $table->string('ho_ten');
            $table->unsignedBigInteger('loai_tai_khoan_id');
            $table->timestamps();
            $table->integer('trang_thai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tai_khoans');
    }
}
