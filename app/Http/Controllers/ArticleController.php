<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\commonHelper\fileHelper;
use Illuminate\Support\Facades\DB;


class ArticleController extends Controller
{
    public  function  addArticle(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'img'=>'required',
            'introduction'=>'required'
        ]);
        $uploadFile=new fileHelper();
        //上传封面图片至腾讯存储空间，上传本地获取文件名
        $filename=$uploadFile->upfile($request->file("img"));
        //$filePath=Storage::disk('upload')->get($filename); 上传文件流
        $filePath=Storage_path('app/uploads/'.$filename);
        $fileFolder='article/'.date('Y-m');
        $uploadFile->upTxCos($filePath,$filename,$fileFolder);//上传到腾讯云
        $uploadFile->upBaiduCos($filePath,$filename,$fileFolder);//上传到百度云
        $uploadFile->upAliCos($filePath,$filename,$fileFolder);//上传到阿里云
        //获取封面图片文件路径
        $fileCurrentUrl=config('appkey.txFrontend.Cos_Host').$fileFolder.'/'.$filename;
        $title=$request->input("title");
        $type=$request->input("type");
        $author=$request->input("author");
        $infosfrom=$request->input("infosfrom");
        $introduction=$request->input("introduction");
        $img=$fileCurrentUrl;
        $created_at=date("Y-m-d H:i:s",time());
        $updated_at=date("Y-m-d H:i:s",time());
        $result=DB::table("articles")->insert([
            'title'=>$title,//标题
            'type'=>$type,//类型
            'author'=>$author,//作者
            'infosfrom'=>$infosfrom,//来源
            'introduction'=>$introduction,//简介
            'img'=>$img,//图片
            'created_at'=>$created_at,
            'updated_at'=>$updated_at
        ]);
        if($result){
            return redirect('/backend/articlelist');
        }else{
            return response()->json($result);
        }
    }
    //编辑文章内容
    public  function  editearticle(Request $request,$id){
        $this->validate($request, [
            'title' => 'required',
            'img'=>'required',
            'introduction'=>'required'
        ]);
        $uploadFile=new fileHelper();
        //上传封面图片至腾讯存储空间，上传本地获取文件名
        $filename=$uploadFile->upfile($request->file("img"));
        //$filePath=Storage::disk('upload')->get($filename); 上传文件流
        $filePath=Storage_path('app/uploads/'.$filename);
        $fileFolder='article/'.date('Y-m');
        $uploadFile->upTxCos($filePath,$filename,$fileFolder);//上传到腾讯云
        $uploadFile->upBaiduCos($filePath,$filename,$fileFolder);//上传到百度云
        $uploadFile->upAliCos($filePath,$filename,$fileFolder);//上传到阿里云
        //获取封面图片文件路径
        $fileCurrentUrl=config('appkey.txFrontend.Cos_Host').$fileFolder.'/'.$filename;
        $title=$request->input("title");
        $type=$request->input("type");
        $author=$request->input("author");
        $infosfrom=$request->input("infosfrom");
        $introduction=$request->input("introduction");
        $img=$fileCurrentUrl;
        $updated_at=date("Y-m-d H:i:s",time());
        $result=DB::table("articles")->where("id",$id)->update([
            'title'=>$title,//标题
            'type'=>$type,//类型
            'author'=>$author,//作者
            'infosfrom'=>$infosfrom,//来源
            'introduction'=>$introduction,//简介
            'img'=>$img,//图片
            'updated_at'=>$updated_at
        ]);
        if($result==1){
            return redirect("/backend/articlelist");
        }else{
            return response()->json($result);
        }
    }
    //删除文章
    public  function  delArticle($id){
        $result=DB::table("articles")->where('id','=',$id)->delete();
        if($result==1){
            return redirect("/backend/articlelist");
        }else{
            return response()->json($result);
        }
    }
    //显示文章列表
    public  function  getArticleList(){
        $articleList=DB::table('articles')->orderBy('id','desc')->paginate(5);
        return response()->json($articleList);
    }
    //显示文章基本信息
    public  function  getArticleInfo($id){
        $articleInfo=DB::table('articles')->where('id',$id)->first();
        return response()->json($articleInfo);
    }
    //显示文章内容信息
    public  function  getArticleContent($articleID){
        $articleContents=DB::table("article_conetents")->where("articleID",$articleID)->orderBy('id','asc')->get();
        return response()->json($articleContents);
    }
    //显示文章标签
    public  function  getArticleTags($articleID){
        $articleTags=DB::table("tags")->where("typeID",$articleID)->orderBy('id','asc')->get();
        return response()->json($articleTags);
    }


    //文章列表
    public  function  articlelist(){
        $info=DB::table('articles')->select('id', 'title','introduction','type','created_at')->orderBy('id','desc')->paginate(5);
        return response()->json($info,200);
    }
    //添加文章内容
    public  function  addarticleContent(Request $request,$id){
        $this->validate($request, [
            'type' => 'required',
            'content'=>'required'
        ]);
        $articleID=$id;
        $type=$request->input('type');
        $content=$request->input('content');
        $created_at=date("Y-m-d H:i:s",time());
        $updated_at=date("Y-m-d H:i:s",time());
        $result=DB::table("article_conetents")->insert([
            'content'=>$content,
            'type'=>$type,
            'articleID'=>$articleID,
            'created_at'=>$created_at,
            'updated_at'=>$updated_at
        ]);
        if($result){
            return redirect('backend/contentlist/'.$id);
        }else{
            return response()->json($result);
        }
    }

//编辑文章内容
    public  function  editarticleContent(Request $request,$id,$articleid){
        $this->validate($request, [
            'type' => 'required',
            'content'=>'required'
        ]);
        $type=$request->input('type');
        $content=$request->input('content');
        $updated_at=date("Y-m-d H:i:s",time());
        $result=DB::table("article_conetents")->where('id',$id)->update([
            'content'=>$content,
            'type'=>$type,
            'updated_at'=>$updated_at
        ]);
        if($result==1){
            return redirect('/backend/contentlist/'.$articleid);
        }else{
            return response()->json($result);
        }
    }
    //删除文章内容
    public  function  delarticleContent($id,$articleid){
        $result=DB::table("article_conetents")->where('id','=',$id)->delete();
        if($result==1){
            return redirect('/backend/contentlist/'.$articleid);
        }else{
            return response()->json($result);
        }
    }
}
