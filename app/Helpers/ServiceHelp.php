<?php
namespace App\Helpers;

use App\Model\Article;
use App\Model\Category;
use Illuminate\Support\Facades\Cache;

class ServiceHelp
{
    /**
     * 获取标签云列表
     * @return array
     */
    public function getTags(){
        $cacheKey = 'article_tags_cache';
        $data = Cache::get($cacheKey, null);
        if($data == null){
            $data = (new Article())->getTags();
            $minutes = $data ? 60*2 : rand(1,5) ;
            Cache::put($cacheKey,$data,$minutes);
        }

        return $data;
    }

    /**
     * 获取点击排行榜列表
     * @return mixed
     */
    public function getRankingList(){
        $cacheKey = 'article_ranking_list_cache';
        $data = Cache::get($cacheKey, null);
        if($data == null){
            $data = (new Article())->getRankingList();
            $minutes = $data ? 60*3 : rand(1,5) ;
            Cache::put($cacheKey,$data,$minutes);
        }

        return $data;
    }

    /**
     * 获取导航栏数据
     * @return array
     */
    public function getNav(){
        $cacheKey = 'article_nav_cache';
        $data = Cache::get($cacheKey, null);
        if($data == null){
            $data = (new Category())->getNav();
            $minutes = $data ? 60*6 : rand(1,5) ;
            Cache::put($cacheKey,$data,$minutes);
        }

        return $data;
    }

     /**
     * 从HTML文本中提取所有图片
     * @param $content
     * @return array
     */
    public function getTtmlImgs($content){
        $pattern="/<img.*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/";
        preg_match_all($pattern,htmlspecialchars_decode($content),$match);
        $data = [];
        if(!empty($match[1])){
            foreach ($match[1] as $img){
                if(!empty($img)){
                    $data[] = $img;
                }
            }
            return $data;
        }

        return $data;
    }
}