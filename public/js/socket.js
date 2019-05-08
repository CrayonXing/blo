(function(w, $){

    function MySocket(opction,callback){

        this.ws         = null;

        this.callback   = callback;

        this.url        = this.handleUrl(opction,callback);

        this.Connect();
    }

    /**
    * 处理包装url
    */
    MySocket.prototype.handleUrl = function(opction,callback){

        if(opction.url.indexOf("?")!=-1) {
            var u = opction.url+'&admin_id='+opction.adminid;
        } else{
            var u = opction.url+'?admin_id='+opction.adminid;
        } 


        $.each(callback,function(k,v){
            // u += '&channel[]='+v.channel;
        });


        return u;
    }

    MySocket.prototype.Connect = function(){
        var _this = this;


        this.ws = new WebSocket(_this.url);


        this.ws.onmessage = function (evt) {
            var msgObj = JSON.parse(evt.data);

            console.log(msgObj);
        };



        this.ws.onclose = function(){ 
            setTimeout(function(){
                console.log("正在自动尝试连接即时通讯服务器..."); 
                _this.Connect();
            },2000);
        };
    }


    w.mySocket = MySocket;
})(window, jQuery);