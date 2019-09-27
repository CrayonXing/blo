    @if(auth('web')->check())
        <a href="/article/editor-md" class="add-article"><i class="am-icon-plus"></i> 编辑文章</a>
    @endif

    <div class="about" >
      <div class="avatar"> <img src="/web/images/touxiao.jpg" alt=""> </div>
      <p class="abname">YuanDong | 3年 <i class="iconfont iconyanjing_bi"></i></p>
      <p class="abposition">PHP开发工程师</p>
      <div class="abtext"> 生活需要梦想、需要坚持。只有不断提高自我，才会得到想要的生活... </div>
    </div>

    @if($tagCloudArr = app('help')->getTags())
        <div class="cloud">
            <h2 class="hometitle">热门标签</h2>
            <ul>
                @foreach($tagCloudArr as $tag=>$num)
                    <a href="/">{{$tag}}</a>
                @endforeach
            </ul>
        </div>
    @endif

    @if($rankingList = app('help')->getRankingList())
        <div class="paihang">
            <h2 class="hometitle">点击排行</h2>
            <ul>
                @foreach($rankingList as $rankingRow)
                    <li>
                        <a href="/article/details/aid/{{$rankingRow['id']}}" target="_blank">{{$rankingRow['title']}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="links">
      <h2 class="hometitle">友情链接</h2>
      <ul>
            <li><a href="https://laravel.sh-jinger.com" target="_blank" >流星博客</a></li>
      </ul>
    </div>