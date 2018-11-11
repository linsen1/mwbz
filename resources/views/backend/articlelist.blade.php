<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>文章列表</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h3 className="text-center">文章列表</h3>
    <ol class="breadcrumb">
        <li><a href="/backend/addarticle">添加文章</a></li>
    </ol>
    <table class="table table-bordered" style="margin-top: 20px">
        <tr>
            <td>序号</td>
            <td>标题</td>
            <td>编辑</td>
            <td>删除</td>
        </tr>
        @foreach ($articlelist as $article)
            <tr>
                <td>{{$article->id}}</td>
                <td>{{$article->title}}</td>
                <td>
                    <a href="/backend/contentlist/{{$article->id}}">添加内容</a>
                    <a href="/backend/taglist/{{$article->id}}/tagtype/0">添加标签</a>
                    &nbsp;<a href="/backend/editearticle/{{$article->id}}">编辑</a>&nbsp;&nbsp;

                </td>
                <td>
                    <form method="post" action="/api/delarticle/{{$article->id}}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-link" onclick="javascript:if(window.confirm('你确定删除？')){return true;}else{return false;}">删除</button></form>
                </td>
            </tr>
        @endforeach

    </table>
    <div style="text-align: center">
        {{ $articlelist ->links() }}
    </div>
</div>
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>
