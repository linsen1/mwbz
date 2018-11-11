<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodPicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_pics', function (Blueprint $table) {
            $table->increments('id');
            $table->string("pic_txt")->comment("美文内容");
            $table->string("index_img_url")->comment("缩略图");
            $table->string("phone_img_url")->comment("手机壁纸");
            $table->integer("phone_img_url_size")->comment("手机壁纸大小");
            $table->string("pc_img_url")->comment("电脑壁纸");
            $table->integer("pc_img_url_size")->comment("电脑壁纸大小");
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
        Schema::dropIfExists('good_pics');
    }
}
