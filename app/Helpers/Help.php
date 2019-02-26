<?php
namespace App\Helpers;

class Help
{
    /**
     * 获取分页总数
     * @param $total
     * @param $page_size
     * @return int
     */
    public function getPageTotal(int $total,int $page_size){
        if($total === 0){
            return 0;
        }

        return (int)ceil((int)$total/(int)$page_size);
    }

    /**
     * 包装分页数据
     * @param array $rows        列表数据
     * @param int $total         数据总记录数
     * @param int $page          当前分页
     * @param int $page_size     分页大小
     * @param array $params      额外参数
     * @return array
     */
    public function packData(array $rows,int $total,int $page,int $page_size,array $params=[])
    {
        return array_merge([
            'rows'          =>$rows,
            'page'          =>$page,
            'page_size'     =>$page_size,
            'page_total'    =>($page_size == 0?1:$this->getPageTotal($total,$page_size)),
            'total'         =>$total,
        ],$params);
    }

    /**
     * 获取标签云列表
     * @return array
     */
    public function getTags(){
        return (new \App\Model\Article())->getTags();
    }

    /**
     * 获取点击排行榜列表
     */
    public function getRankingList(){
        return (new \App\Model\Article())->getRankingList();
    }

    /**
     * 获取导航栏数据
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