<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNguyenLieusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nguyen_lieus', function (Blueprint $table) {
            $table->id(); //                                1.                2             3               
            $table->string('ten_nguyen_lieu'); //           xà lách           xà lách            
            $table->float('don_gia');
            $table->float('so_luong');//                    100               50
            $table->unsignedBigInteger('don_vi_tinh_id');
            $table->unsignedBigInteger('kho_id'); //        1                 2             3                 
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
        Schema::dropIfExists('nguyen_lieus');
    }
}
