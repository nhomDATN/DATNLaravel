<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuaHangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noi_lam_viecs', function (Blueprint $table) {
            $table->id();
            $table->string('ma_noi_lam_viec'); // CH1, CH2, CH3... K1,K2,K3... [Cua hang - Kho]
            $table->string('dia_chi');
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
        Schema::dropIfExists('noi_lam_viecs');
    }
}
