<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\commonHelper\fileHelper;
use Illuminate\Support\Facades\DB;
use App\PicArticle;
use App\GoodPic;

class PicController extends  Controller
{
    public  function  addPic(Request $request){
        $this->validate($request,[
            'pic_txt'=>'required'
        ]);
        $picinfo=new GoodPic();
        $picinfo->pic_txt=$request->input("pic_txt");

        $uploadFile=new fileHelper();
        $fileFolder='mvbz/'.date('Y-m');
        //上传封面图片至腾讯存储空间，上传本地获取文件名
        $index_img_url_filename=$uploadFile->upfile($request->file("index_img_url"));
        //$filePath=Storage::disk('upload')->get($filename); 上传文件流
        $index_img_url_filename_filePath=Storage_path('app/uploads/'.$index_img_url_filename);
        $uploadFile->upTxCos($index_img_url_filename_filePath,$index_img_url_filename,$fileFolder);//上传到腾讯云
        $index_img_url_filename_fileCurrentUrl=config('appkey.txFrontend.Cos_Host').$fileFolder.'/'.$index_img_url_filename;
        $picinfo->index_img_url=$index_img_url_filename_fileCurrentUrl;


        $phone_img_url_filename=$uploadFile->upfile($request->file("phone_img_url"));
        //$filePath=Storage::disk('upload')->get($filename); 上传文件流
        $phone_img_url_filename_filePath=Storage_path('app/uploads/'.$phone_img_url_filename);
        $uploadFile->upTxCos($phone_img_url_filename_filePath,$phone_img_url_filename,$fileFolder);//上传到腾讯云
        $phone_img_url_fileCurrentUrl=config('appkey.txFrontend.Cos_Host').$fileFolder.'/'.$phone_img_url_filename;
        $picinfo->phone_img_url=$phone_img_url_fileCurrentUrl;
        $picinfo->phone_img_url_size=$request->input("phone_img_url_size");

        $pc_img_url_filename=$uploadFile->upfile($request->file("pc_img_url"));
        //$filePath=Storage::disk('upload')->get($filename); 上传文件流
        $pc_img_url_filename_filePath=Storage_path('app/uploads/'.$pc_img_url_filename);
        $uploadFile->upTxCos($pc_img_url_filename_filePath,$pc_img_url_filename,$fileFolder);//上传到腾讯云
        $pc_img_url_fileCurrentUrl=config('appkey.txFrontend.Cos_Host').$fileFolder.'/'.$pc_img_url_filename;
        $picinfo->pc_img_url=$pc_img_url_fileCurrentUrl;
        $picinfo->pc_img_url_size=$request->input("pc_img_url_size");

        $result=$picinfo->save();
        if($result){
            return response()->redirectTo('/backend/piclist');
        }else{
            return response()->json("false");
        }
    }

    public  function editPic(Request $request,$id){
        $this->validate($request,[
            'pic_txt'=>'required'
        ]);
        $picinfo=GoodPic::find($id);
        $picinfo->pic_txt=$request->input("pic_txt");

        $uploadFile=new fileHelper();
        $fileFolder='mvbz/'.date('Y-m');
        //上传封面图片至腾讯存储空间，上传本地获取文件名
        $index_img_url_filename=$uploadFile->upfile($request->file("index_img_url"));
        //$filePath=Storage::disk('upload')->get($filename); 上传文件流
        $index_img_url_filename_filePath=Storage_path('app/uploads/'.$index_img_url_filename);
        $uploadFile->upTxCos($index_img_url_filename_filePath,$index_img_url_filename,$fileFolder);//上传到腾讯云
        $index_img_url_filename_fileCurrentUrl=config('appkey.txFrontend.Cos_Host').$fileFolder.'/'.$index_img_url_filename;
        $picinfo->index_img_url=$index_img_url_filename_fileCurrentUrl;


        $phone_img_url_filename=$uploadFile->upfile($request->file("phone_img_url"));
        //$filePath=Storage::disk('upload')->get($filename); 上传文件流
        $phone_img_url_filename_filePath=Storage_path('app/uploads/'.$phone_img_url_filename);
        $uploadFile->upTxCos($phone_img_url_filename_filePath,$phone_img_url_filename,$fileFolder);//上传到腾讯云
        $phone_img_url_fileCurrentUrl=config('appkey.txFrontend.Cos_Host').$fileFolder.'/'.$phone_img_url_filename;
        $picinfo->phone_img_url=$phone_img_url_fileCurrentUrl;
        $picinfo->phone_img_url_size=$request->input("phone_img_url_size");

        $pc_img_url_filename=$uploadFile->upfile($request->file("pc_img_url"));
        //$filePath=Storage::disk('upload')->get($filename); 上传文件流
        $pc_img_url_filename_filePath=Storage_path('app/uploads/'.$pc_img_url_filename);
        $uploadFile->upTxCos($pc_img_url_filename_filePath,$pc_img_url_filename,$fileFolder);//上传到腾讯云
        $pc_img_url_fileCurrentUrl=config('appkey.txFrontend.Cos_Host').$fileFolder.'/'.$pc_img_url_filename;
        $picinfo->pc_img_url=$pc_img_url_fileCurrentUrl;
        $picinfo->pc_img_url_size=$request->input("pc_img_url_size");

        $result=$picinfo->save();
        if($result){
            return response()->redirectTo('/backend/piclist');
        }else{
            return response()->json("false");
        }
    }

    public  function  delPic($id){
        $picinfo=GoodPic::find($id);
        $result=$picinfo->delete();
        if($result){
            return response()->redirectTo('/backend/piclist');
        }else{
            return response()->json("false");
        }
    }

    public function addPicArticle(Request $request,$picid){
        $this->validate($request,[
            'article_id'=>'required'
        ]);
        $picArticleInfo=new PicArticle();
        $picArticleInfo->pic_id=$picid;
        $picArticleInfo->article_id=$request->input("article_id");
        $picArticleInfo->article_title=$request->input("article_title");
        $result=$picArticleInfo->save();
        if($result){
            return response()->redirectTo('/backend/picArticleList/'.$picid);
        }else{
            return response()->json("false");
        }
    }
    public function editPicArticle(Request $request,$id,$picid){
        $this->validate($request,[
            'article_id'=>'required'
        ]);
        $picArticleInfo=PicArticle::find($id);
        $picArticleInfo->pic_id=$picid;
        $picArticleInfo->article_id=$request->input("article_id");
        $picArticleInfo->article_title=$request->input("article_title");
        $result=$picArticleInfo->save();
        if($result){
            return response()->redirectTo('/backend/picArticleList/'.$picid);
        }else{
            return response()->json("false");
        }
    }
    public function delpicArticle(Request $request,$id,$picid){

        $picArticleInfo=PicArticle::find($id);
        $result=$picArticleInfo->delete();
        if($result){
            return response()->redirectTo('/backend/picArticleList/'.$picid);
        }else{
            return response()->json("false");
        }
    }
}
