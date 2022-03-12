<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoaiKhuyenMaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loai_khuyen_mais', function (Blueprint $table) {
            $table->id();                          // 1                       2               3
            $table->string('ten_loai_khuyen_mai'); // khuyến mãi thường 1     voucher         khuyến mãi thường 2
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
        Schema::dropIfExists('loai_khuyen_mais');
    }
}
