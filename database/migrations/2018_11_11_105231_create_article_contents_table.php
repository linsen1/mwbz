<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('article_conetents', function (Blueprint $table) {
            $table->increments('id')->comments("文章类容主键");
            $table->string("articleID")->comments("关联的文章主键");
            $table->integer("type")->comments("内容类型：0文本 1代码 2图片");
            $table->text("content")->commenets("文章内容");
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
        Schema::dropIfExists('article_contents');
    }
}
