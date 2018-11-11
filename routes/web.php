<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\PicArticle;
use App\GoodPic;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix("backend/")->group(function (){
    Route::get("articlelist",function (){
        $articlelist=DB::table('articles')->select('id','title')->orderBy('id','desc')->paginate(20);
        return view('backend.articlelist',['articlelist'=>$articlelist]);
    });
    Route::get("addarticle",function (){
        return view('backend.addarticle');
    });
    Route::get("editearticle/{id}",function ($id){
        $article=DB::table("articles")->where('id',$id)->first();
        return view("backend.editArticle",["article"=>$article,'id'=>$id]);
    });
//文章列表
    Route::get("contentlist/{id}",function ($id){
        $contentlist=DB::table("article_conetents")->select('id','articleID','content','created_at')->where('articleID',$id)->orderBy('id','asc')->paginate(20);
        return view('backend.contentlist',['contentlist'=>$contentlist,'articleID'=>$id]);
    });
    Route::get("addarticlecontent/{id}",function ($id){
        return view('backend.addarticlecontent',['id'=>$id]);
    });
    Route::get("editArticleContent/{id}/articleid/{articleid}",function ($id,$articleid){
        $contents=DB::table("article_conetents")->where("id",$id)->first();
        return view('backend.editArticleContent',['contents'=>$contents,'id'=>$id,'articleid'=>$articleid]);
    });

    //文章标签列表
    Route::get("taglist/{id}/tagtype/0",function ($id){
        $taglist=DB::table("tags")->select('id','tagname','created_at')->where([
            ['type','=',0],
            ['typeID','=',$id]
        ])->orderBy('id','desc')->paginate(20);
        return view('backend.taglist',['taglist'=>$taglist,'articleID'=>$id]);
    });
//添加标签
    Route::get('addtag/{id}/type/0',function ($id){
        return view('backend.addtag',['articleID'=>$id]);
    });
//编辑标签
    Route::get('edittag/{id}/articleid/{articleid}/type/0',function ($id,$articleid){
        $tag=DB::table("tags")->where("id",$id)->first();
        return view('backend.edittag',['id'=>$id,'articleid'=>$articleid,'type'=>0,'tag'=>$tag]);
    });

    Route::get("piclist",function (){
        $piclist=GoodPic::where("id",">","0")->orderBy('id', 'desc')->paginate(10);
        return view('backend.piclist',['piclist'=>$piclist]);
    });
    Route::get("addpic",function (){
       return view("backend.addpic");
    });
    Route::get("editPic/{id}",function ($id){
        $picinfo=GoodPic::find($id);
        return view("backend.editPic",['picinfo'=>$picinfo]);
    });

    Route::get("picArticleList/{picid}",function($picid){
        $picArticleList=PicArticle::where("pic_id","=",$picid)->orderBy('id','desc')->paginate(10);
        return view("backend.picArticleList",['picArticleList'=>$picArticleList,'picid'=>$picid]);
    });
    Route::get("addPicArticle/{picid}",function ($picid){
        return view("backend.addPicArticle",['picid'=>$picid]);
    });
    Route::get("editPicArticle/id/{id}/picid/{picid}",function($id,$picid){
        $PicInfo=PicArticle::find($id);
        return view("backend.editPicArticle",['PicInfo'=>$PicInfo,'id'=>$id,'picid'=>$picid]);
    });
});
