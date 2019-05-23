<?php
namespace App\Http\Traits;


trait DTrait
{

    /**
     * 获取分页总数
     * @param $total
     * @param $page_size
     * @return int
     */
    function getPageTotal(int $total,int $page_size){
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
            'page_total'    =>($page_size == 0?1:$this->getPageTotal($total,$page_size)),
            'total'         =>$total,
        ],$params);
    }
}