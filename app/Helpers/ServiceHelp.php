<?php
namespace App\Helpers;

class ServiceHelp
{
    /**
     * 获取标签云列表
     * @return array
     */
    public function getTags(){
        return (new \App\Model\Article())->getTags();
    }

    /**
     * 获取点击排行榜列表
     * @return mixed
     */
    public function getRankingList(){
        return (new \App\Model\Article())->getRankingList();
    }

    /**
     * 获取导航栏数据
     * @return array
     */
    public function getNav(){
        return (new \App\Model\Category())->getNav();
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