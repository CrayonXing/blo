<?php
/**
 * 系统公共函数方法
 */

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
function packData(array $rows,int $total,int $page,int $page_size,array $params=[])
{
    return array_merge([
        'rows'          =>$rows,
        'page'          =>$page,
        'page_size'     =>$page_size,
        'page_total'    =>($page_size == 0?1:getPageTotal($total,$page_size)),
        'total'         =>$total,
    ],$params);
}

/**
 * 从HTML文本中提取所有图片
 * @param $content
 * @return array
 */
function getTtmlImgs($content){
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

/**
 * 二维数组通过指定的key 进行分类
 * @param array $array
 * @param $index
 * @return array
 */
function arrClassify(array $array,$index){
    $result = [];
    foreach($array as $value){
        $result[$value[$index]][] = $value;
    }

    return $result;
}

/**
 * 生成6位字符的短码字符串
 * @param string $string
 * @return string
 */
function inviteCode(string $string)
{
    $result= sprintf("%u",crc32($string));
    $show = '';
    while($result>0){
        $s = $result % 62;
        if ($s  >35){
            $s = chr($s+61);
        }elseif($s>9 && $s <= 35){
            $s = chr($s+55);
        }
        $show.=$s;
        $result=floor($result/62);
    }

    return $show;
}


/**
 *
 */
function replaceArrayKey($key,$array){
    if(empty($array)) return [];

    $arr = [];
    foreach ($array as $value){
        $arr[$value['id']] = $value;
    }

    return $arr;
}


/**
 * 求两个日期之间相差的天数
 * (针对1970年1月1日之后，求之前可以采用泰勒公式)
 * @param string $day1
 * @param string $day2
 * @return number
 */
function diffBetweenTwoDays ($day1, $day2){
    $second1 = strtotime(date('Y-m-d',strtotime($day1)));
    $second2 = strtotime(date('Y-m-d',strtotime($day2)));
    if ($second1 < $second2) {
        $tmp = $second2;
        $second2 = $second1;
        $second1 = $tmp;
    }
    return intval(round(($second1 - $second2) / 86400));
}

/**
 * 手机号脱敏
 * @param $mobile     手机号
 * @return mixed
 */
function mobileFilter($mobile){
    return substr_replace($mobile,'****',3,4);
}