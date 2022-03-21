<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKhosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khos', function (Blueprint $table) {
            $table->id();
            $table->string('ma_kho')->unique()->primarykey();
            $table->string('ten_kho');
            $table->string('dia_chi');
            $table->integer('trang_thai');
            $table->unsignedBigInteger('nhan_vien_id');
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
        Schema::dropIfExists('kho_nguyen_lieus');
    }
}
