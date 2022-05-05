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
            $table->string('ten_nv',100);
            $table->string('ma_nv',50);
            $table->tinyInteger('gioi_tinh');
            $table->date('ngay_sinh');
            $table->string('noi_sinh',100);
            $table->integer('phongban_id');
            $table->integer('bangcap_id');
            $table->string('image_path')->nullable();
            $table->string('image_name')->nullable();
            $table->softDeletes();
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
