<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhanPhoisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phan_phois', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('noi_phan_phoi_id');
            $table->unsignedBigInteger('nguyen_lieu_id');
            $table->unsignedBigInteger('don_vi_tinh_id');
            $table->unsignedBigInteger('kho_id');
            $table->integer('so_luong');
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
        Schema::dropIfExists('phan_phois');
    }
}
