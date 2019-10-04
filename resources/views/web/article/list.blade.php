@extends('web.layouts.blog-layout')

@section('content')
  
<article>
  <h1 class="t_nav">
    <span class="t_nav_left" >首页 > 分类 > {{ $category }} </span>
    <span class="t_nav_right" id="nav-slogan">不要轻易放弃。学习成长的路上，我们长路漫漫，只因学无止境。 </span>
  </h1>

  <div class="blogs">
    <div class="mt20"></div>
    <div id="blog-list-container"></div>
    <div id="blog-list-paging">
           <i class="am-icon-spinner am-icon-pulse"></i> 数据加载中...
    </div>
  </div>

  <div class="sidebar sidebar-padding" >
    @include('web.article.sidebar')
  </div>
</article>

@endsection

@push('scripts')
<script src="/plugin/template-web.js"></script>

@include('web.template.tpl-blog-list')

<script type="text/javascript">
    const  category = "{{$cid}}";
    var o = {
        pagingShow:function(type){
            if(type == 0){
                $('#blog-list-paging').html('<i class="iconfont icon-xia"></i> 加载更多... ');
            }else if(type == 1){
                $('#blog-list-paging').html('<i class="am-icon-spinner am-icon-pulse"></i> 数据加载中... ');
            }else{
                $('#blog-list-paging').html('已加载全部').css('color','#ccc');
            }
        },
        loading:false,
        page:0,
        page_size:20,
        loadListData:function(){
            if(this.loading == false){
              o.page++;
              $.ajax({
                  url: "/article/search",
                  type: 'get',
                  data: {page:o.page,page_size:o.page_size,cid:category},
                  dataType: 'json',
                  beforeSend: function () {
                      o.pagingShow(1);
                      o.loading = true;
                  },
                  success: function (res) {
                      o.loading = false;
                      if(res.code == 200){
                          if(res.data.rows.length > 0){
                              $('#blog-list-container').append(template("tpl-blog-list",{rows:res.data.rows}));
                              if(res.data.page == res.data.page_total){
                                  o.pagingShow(2);
                                  o.loading = true;
                              }else{
                                  o.pagingShow(0);
                              }
                          }else{
                              o.pagingShow(2);
                          }
                      };
                  },
                  error:function(){
                    o.pagingShow(0);
                  }
              });
            }
            return this;
        }
    };

    o.loadListData();

    $('#blog-list-paging').on('click',function(){
        o.loadListData();
    });
</script>
@endpush