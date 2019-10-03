<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8" />
    <title>New博客 - 文章编辑</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/plugin/editor-md/css/editormd.css" />
    <link rel="stylesheet" href="/plugin/tagsInput/jquery.tagsinput-revisited.css"/>
    <link rel="stylesheet" href="/static/web/css/markdown-edit-page.css"/>
</head>
<body>
<div >
    <div class="medit-header">
        <div class="medit-header-son medit-header-lson" >
            <input type="hidden" id="fr-input-id" value="{{@$info->id}}">
            <input type="text" id="fr-input-title" placeholder="请输入文章标题(必填)"  value="{{@$info->title}}">
            <input type="text" id="fr-input-describe" placeholder="文章摘要(可选)" value="{{@$info->describe}}" >
            <input id="fr-blog-tags" type="text" value="{{@$info->tag}}">
        </div>
        <div class="medit-header-son">
            <div class="son-left-box">
                <img src="{{@$info->img}}" onerror="this.src='/static/web/images/xitongempty.png'" id="artcle-img" >
                <form id="form-upload-file" enctype="multipart/form-data">
                    <p>
                        <span style="">文章宣传图(点击上传)</span>
                        <input type="file" name="file-img" id="upload-container-input" >
                    </p>
                </form>
            </div>
            <div class="son-right-box">
                <div >
                    <span class="left-tilte">文章栏目:</span>
                    <p class="artcle-type-box" style="cursor: pointer" id="fr-choice-category" data-cid="{{@$info->category_id}}" >
                        @if($info)
                                @foreach($categoryInfos as $category2)
                                    @if($category2['id'] == $info->category_id)
                                    {{$category2['name']}}
                                    @endif
                                @endforeach
                            @else
                            请选择文章所在栏目(必选)
                        @endif
                    </p>
                    <div class="category-box">
                        @foreach($categoryInfos as $category)
                            <p data-id="{{$category['id']}}" >{{$category['name']}}</p>
                        @endforeach
                    </div>
                </div>

                <div >
                    <span class="left-tilte">原文链接:</span>
                    <input type="text" placeholder="原文链接(可选)" id="original-text-link" value="{{@$info->reprint_url}}" >
                </div>

                <div >
                    <span class="left-tilte">是否公开:</span>
                    <p class="artcle-type-box">
                        <span class="artcle-type-btn artcle-type-active" data-val="1" >公开</span>
                        <span class="artcle-type-btn" data-val="2">私有</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div id="container-editormd">
        <textarea style="display: none" >{{@$info->markdown_content}}</textarea>
    </div>
</div>

<div id="uplod-mask-box"><div  id="uplod-mask-tips">图片上传中,请耐心等待...</div></div>

<script type="text/javascript" src="/static/web/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/plugin/editor-md/editormd.min.js"></script>
<script type="text/javascript" src="/plugin/tagsInput/jquery.tagsinput-revisited.js"></script>
<script type="text/javascript" src="/static/web/js/page/editor-article-page.js"></script>
</body>
</html>