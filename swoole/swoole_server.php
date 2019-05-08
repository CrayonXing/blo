<?php

class WsServer{

	CONST HOST 			= "0.0.0.0";
    CONST PORT 			= 1215;


    /**
     * swoole websocket server 实例对象
     * [$ws description]
     * @var null
     */
	public $ws  	=	 null;
	public $redis 	=	 null;

	/**
	 * 初始化方法
	 * [__construct description]
	 */
	public function __construct(){
		$this->ws = new \swoole_websocket_server(self::HOST, self::PORT);
		$this->ws->set([
            'worker_num' => 4,
            'task_worker_num'=>2,
            'document_root' => '/www/laravel5.7/public/',
            'enable_static_handler' => true,
        ]);

        $this->ws->on("start", [$this, 'onStart']);
        $this->ws->on("open", [$this, 'onOpen']);
        $this->ws->on("message", [$this, 'onMessage']);
        $this->ws->on("workerstart", [$this, 'onWorkerStart']);
        $this->ws->on("request", [$this, 'onRequest']);
        $this->ws->on('task', [$this, 'onTask']);  
        $this->ws->on('finish', [$this, 'onFinish']); 
        $this->ws->on("close", [$this, 'onClose']);


        $this->ws->start();
	}

	/**
     * 服务启动时定义进程别名
     * @param $server
     */
    public function onStart($server) {
        swoole_set_process_name("swoole ws");
    }

    /**
     * 连接池
     * @param $server
     * @param $worker_id
     */
    public function onWorkerStart($server,  $worker_id) {
        //加载index文件的内容
        require __DIR__ . '/../vendor/autoload.php';
        require_once __DIR__ . '/../bootstrap/app.php';
    }

    /**
     * swoole http 入口
     * [onRequest description]
     * @param  [type] $request  [description]
     * @param  [type] $response [description]
     * @return [type]           [description]
     */
    public function onRequest($request, $response){

    	//server信息
        if (isset($request->server)) {
            foreach ($request->server as $k => $v) {
                $_SERVER[strtoupper($k)] = $v;
            }
        }

        //header头信息
        if (isset($request->header)) {
            foreach ($request->header as $k => $v) {
                $_SERVER[strtoupper($k)] = $v;
            }
        }

        //get请求
        if (isset($request->get)) {
            foreach ($request->get as $k => $v) {
                $_GET[$k] = $v;
            }
        }

        //post请求
        if (isset($request->post)) {
            foreach ($request->post as $k => $v) {
                $_POST[$k] = $v;
            }
        }

        //文件请求
        if (isset($request->files)) {
            foreach ($request->files as $k => $v) {
                $_FILES[$k] = $v;
            }
        }

        //cookies请求
        if (isset($request->cookie)) {
            foreach ($request->cookie as $k => $v) {
                $_COOKIE[$k] = $v;
            }
        }

        $_SERVER['swoole_socket'] = $this->ws;

        ob_start();//启用缓存区

        //加载laravel请求核心模块
        $kernel = app()->make(Illuminate\Contracts\Http\Kernel::class);
        $laravelResponse = $kernel->handle(
            $request = Illuminate\Http\Request::capture()
        );
        $laravelResponse->send();
        $kernel->terminate($request, $laravelResponse);

        $res = ob_get_contents();//获取缓存区的内容
        ob_end_clean();//清除缓存区

        //输出缓存区域的内容
        $response->end($res);
    }

    /**
     * 监听ws连接事件
     * @param $ws
     * @param $request
     */
    public function onOpen($serv, $request) {
        $serv->push($request->fd,json_encode(['name'=>'yuandong11111']));
    }

    /**
     * 监听ws消息事件
     * @param $ws
     * @param $frame
     */
    public function onMessage($ws, $frame) {
        
    }

    /**
     * close
     * @param $ws
     * @param $fd
     */
    public function onClose($ws, $fd) {
        
    }

    public function onTask($serv, $task_id, $from_id, $data)  
    {  
        return '-------';
    }  
  
    public function onFinish($serv, $task_id, $data)  
    {  
        //echo "Task {$task_id} finish\n";  
        //echo "Result: {$data}\n";  
    }  
}

new WsServer();