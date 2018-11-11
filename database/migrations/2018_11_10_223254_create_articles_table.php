<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id')->comment("主键");
            $table->string("title")->comment("文章标题");
            $table->string("introduction")->comment("简介")->nullable();
            $table->string("author")->comment("作者")->nullable();
            $table->string("infosfrom")->comment("来源")->nullable();
            $table->integer("type")->comment("类型：0 资讯 1 英文杂志 2 教程");
            $table->string("img")->comment("图片")->nullable();
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
        Schema::dropIfExists('articles');
    }
}
