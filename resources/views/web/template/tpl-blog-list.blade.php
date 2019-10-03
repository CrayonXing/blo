<script id="tpl-blog-list" type="text/html">
    @{{each rows as v index}}
        <li   @{{if index%2 }} class="animated fadeIn" @{{ else}} class="animated fadeIn" @{{/if}} >
          @{{if v.img }}
            <span class="blogpic">
              <a href="/p/@{{v.short_code}}" target="_blank"><img src="@{{v.img}}"></a>
            </span>
          @{{/if}}

          <h3 class="blogtitle">
              <a href="/p/@{{v.short_code}}" target="_blank">@{{v.title}}</a>
          </h3>

          @{{if v.describe }}
            <div class="bloginfo">
              <p>@{{v.describe}}</p>
            </div>
          @{{/if}}

          <div class="autor">
            <span class="lm">
              @{{each v.tag as tag index2}}
                <a href="/"  target="_blank" class="classname">
                   @{{tag}}
                </a>
              @{{/each}}
              
            </span>
            <span class="dtime">@{{v.created_time}}</span>
            <span class="viewnum">浏览（<a>@{{v.visits}}</a>）</span>
            <span class="readmore"><a href="/p/@{{v.short_code}}"  target="_blank">阅读原文...</a></span>
          </div>
        </li>
    @{{/each}}
  </script>