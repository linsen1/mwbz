<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class tagController extends Controller
{
    //
    public  function  addTag(Request $request,$id,$type){
        $this->validate($request, [
            'tagname' => 'required'
        ]);
        $tagname=$request->input("tagname");
        $typeid=$id;//文章，资源ID
        $types=$type;//类型 0 文章 1 资源
        $created_at=date("Y-m-d H:i:s",time());
        $updated_at=date("Y-m-d H:i:s",time());
        $result=DB::table("tags")->insert([
            'tagname'=>$tagname,
            'type'=>$types,
            'typeid'=>$typeid,
            'created_at'=>$created_at,
            'updated_at'=>$updated_at
        ]);
        if($result){
            return redirect('/backend/taglist/'.$id.'/tagtype/'.$type);
        }else{
            return response()->json($result);
        }
    }
    public  function  delTag($id,$artilceid,$type){
        $result=DB::table("tags")->where('id','=',$id)->delete();
        if($result==1){
            return redirect('/backend/taglist/'.$artilceid.'/tagtype/'.$type);
        }else{
            return response()->json($result);
        }
    }
    //更新标签
    public  function  updateTag(Request $request,$id,$artilceid,$type){
        $this->validate($request, [
            'tagname' => 'required'
        ]);
        $tagname=$request->input("tagname");
        $updated_at=date("Y-m-d H:i:s",time());

        $result=DB::table("tags")->where('id',$id)->update(
            [
                'tagname'=>$tagname,
                'updated_at'=>$updated_at
            ]
        );
        if($result==1){
            return redirect('backend/taglist/'.$artilceid.'/tagtype/'.$type);
        }else{
            return response()->json($result);
        }
    }

}
