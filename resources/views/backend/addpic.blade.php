<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>文章内容列表</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">

    <!-- Include Editor style. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/css/froala_style.min.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="container">

    <h3 class="text-center">添加壁纸</h3>
    <div style="text-align: left;margin-top: 10px">
        <form class="form-horizontal" method="post" action="/api/addPic" enctype="multipart/form-data" >
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="pic_txt">壁纸标题:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="pic_txt" name="pic_txt" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="index_img_url">美文图片:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file"  name="index_img_url"  id="index_img_url" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="phone_img_url">手机壁纸:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file"  name="phone_img_url"  id="phone_img_url" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="phone_img_url_size">手机壁纸大小(MB):</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="phone_img_url_size" name="phone_img_url_size" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="pc_img_url">PC壁纸:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file"  name="pc_img_url"  id="pc_img_url" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="pc_img_url_size">PC壁纸大小(MB):</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="pc_img_url_size" name="pc_img_url_size" >
                </div>
            </div>

            <div style="text-align: center">
                <button type="submit" class="btn btn-default" style="vertical-align: middle;text-align: center; ">添加</button>
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>

    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>

<!-- Include Editor JS files. -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/js/froala_editor.pkgd.min.js"></script>

<!-- Initialize the editor. -->


<script src="/js/bootstrap.min.js"></script>
</body>
</html>
