<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'article';

    /**
     * 不能被批量赋值的属性
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['category_id','uid','title','tag','describe','imgs','content','status','created_time','updated_time'];

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 添加
     *
     * @var bool
     */
    public function saveArticle($params=[],$isDraft = false,$id = 0){
		$data = [
    		'category_id'		=>$params['category_id'],
    		'uid'				=>$params['uid'],
    		'title'				=>$params['title'],
    		'tag'				=>$params['tag'],
    		'describe'			=>$params['describe'],
    		'imgs'				=>json_encode($params['imgs']),
    		'content'			=>$params['content']
    	];

    	if($isDraft === true){
    		$data['status'] = 0;
    	}else{
    		$data['status'] = 1;
    	}

    	if($id == 0){
    		$data['created_time'] = date('Y-m-d H:i:s');
    		$data['updated_time'] = date('Y-m-d H:i:s');
			$isTrue  = self::create($data);
			if($isTrue){
	    		return [true,'文章添加完成',null];
	    	}else{
				return [false,'文章添加失败'];
	    	}
    	}else{
    		$data['updated_time'] = date('Y-m-d H:i:s');
    		$isTrue  = self::where('id', $id)->where('uid',$params['uid'])->update($data);
    		if($isTrue === false){
	    		return [true,'文章编辑完成',null];
	    	}else{
				return [false,'文章编辑失败',null];
	    	}
    	}
    }
}
