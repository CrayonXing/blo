@extends('web.layouts.blog-layout')

@section('content')
    <link rel="stylesheet" href="/plugin/Swiper/swiper.min.css">

    <article>
      <div class="blogs">
          <div class="swiper-container"style="margin-top: -15px;margin-bottom: 10px;height: 400px;">
              <div class="swiper-wrapper">
                  <div class="swiper-slide"><img src="https://up.enterdesk.com/edpic_source/53/f4/40/53f440313e932a14b768fc3130feb5ea.jpg" style="width: 100%;height: 100%" /></div>
                  <div class="swiper-slide"><img src="https://up.enterdesk.com/edpic_source/73/01/3b/73013b1c9c41e0648c93ed82aa9c5eb3.jpg" style="width: 100%;height: 100%" /></div>
                  <div class="swiper-slide"><img src="/web/images/1550999711(1).png" style="width: 100%;height: 100%" /></div>
              </div>
              <div class="swiper-pagination"></div>
          </div>
          <div id="blog-list-container"></div>
          <div id="blog-list-paging">
               <i class="am-icon-spinner am-icon-pulse"></i> 数据加载中...
          </div>
      </div>
      <div class="sidebar" >
            @include('web.article.sidebar')
        </div>
      </div>
    </article>
@endsection

@push('scripts')
  <script src="/plugin/Swiper//swiper.min.js"></script>
  <script src="/plugin/template-web.js"></script>
  @include('web.template.tpl-blog-list')
    <script>
        var swiper = new Swiper('.swiper-container', {
            pagination: {
                el: '.swiper-pagination',
            },
        });
    </script>
<script type="text/javascript">
    var o = {
        pagingShow:function(type){
            if(type == 0){
                $('#blog-list-paging').html('<i class="iconfont icon-xia"></i> 加载下一页 ').css('color','rgb(128, 120, 120)');
            }else if(type == 1){
                $('#blog-list-paging').html('<i class="am-icon-spinner am-icon-pulse"></i> 数据加载中...').css('color','rgb(128, 120, 120)');
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
                  data: {page:o.page,page_size:o.page_size},
                  dataType: 'json',
                  beforeSend: function () {
                      o.pagingShow(1);
                      o.loading = true;
                  },
                  success: function (res) {
                      o.loading = false;
                      if(res.code == 200 && res.data.rows.length > 0){
                          $('#blog-list-container').append(template("tpl-blog-list",{rows:res.data.rows}));
                            if(res.data.page == res.data.page_total){
                              o.pagingShow(2);
                              console.log('已加载全部');
                              o.loading = true;
                          }else{
                            o.pagingShow(0);
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

    setTimeout(function(){
      o.loadListData();
    },1000);
    

    $('#blog-list-paging').on('click',function(){
        o.loadListData();
    });
</script>
@endpush