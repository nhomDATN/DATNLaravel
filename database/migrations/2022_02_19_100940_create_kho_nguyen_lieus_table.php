<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKhoNguyenLieusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kho_nguyen_lieus', function (Blueprint $table) {
            $table->id();
            $table->string('ten_kho');
            $table->string('dia_chi');
            $table->unsignedBigInteger('nha_cung_cap_id');
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
