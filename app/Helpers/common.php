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


function formatSpecsData($data){
    $specs = [];
    foreach ($data as $specName =>$specArr){
        $tmpArr = array_collapse(current($specArr));
        foreach ($tmpArr as $tmpArrKey=>$tmpArrVal){
            $tmpArr[$tmpArrKey] = $tmpArrVal == 'true'?true:false;
        }
        $specs[key($specArr)] = $tmpArr;
    }

    return $specs;
}


/**
 * 获取唯一订单编号
 * @param int $n         必须大于14
 * @return string
 */
function getGoodsNo($n=20){
    $m=$n-13;
    if($m<=0) $m=1;
    $rand_num_min=0;
    $rand_num_max=str_repeat(9,$m);
    $seconds=sprintf("%05d", (time() - mktime(0,0,0)) );
    return date("ymd",time()).$seconds. sprintf("%0".$m."d", rand($rand_num_min, $rand_num_max));
}

/**
 * 验证是否为整数
 * @param $value
 * @param bool $is_negative       是否可为负数
 * @return bool
 */
function isInteger($value,$is_negative=false){

    if(!is_numeric($value) || strpos($value,".")!==false){
        return false;
    }

    if(!$is_negative && $value < 0){
        return false;
    }

    return true;
}

/**
 * 验证ID数组是否为整数
 */
function checkIds(array $arr){
    foreach ($arr as $v){
        if(!isInteger($v)){
            return false;
        }
    }

    return true;
}

/**
 * 商品SKU数据格式化
 * @param $array
 * @return string
 */
function formatSpec($array){
    $specStr = '';
    if($array){
        foreach ($array as $specKey=>$specVal){
            $specStr .= "{$specKey}:$specVal;";
        }
    }

    return $specStr;
}

/**
 * 获取唯一订单编号
 * @param int $n         必须大于14
 * @return string
 */
function getOrderNo($n=20){
    $m=$n-13;
    if($m<=0) $m=1;
    $rand_num_min=0;
    $rand_num_max=str_repeat(9,$m);
    $seconds=sprintf("%05d", (time() - mktime(0,0,0)) );
    return date("Ymd",time()).$seconds. sprintf("%0".$m."d", rand($rand_num_min, $rand_num_max));
}


/**
 * 获取随机字符串
 * @param number $length 长度
 * @param string $type 类型
 * @param number $convert 转换大小写
 * @return string 随机字符串
 */
function random($length = 6, $type = 'string', $convert = 0)
{
    $config = array(
        'number' => '1234567890',
        'letter' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
        'string' => 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789',
        'all' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
    );

    if (!isset($config[$type]))
        $type = 'string';
    $string = $config[$type];

    $code = '';
    $strlen = strlen($string) - 1;
    for ($i = 0; $i < $length; $i++) {
        $code .= $string{mt_rand(0, $strlen)};
    }
    if (!empty($convert)) {
        $code = ($convert > 0) ? strtoupper($code) : strtolower($code);
    }
    return $code;
}


function getTree($data, $pId){
    $tree = [];
    foreach($data as $k => $v)
    {
        if($v['parent_id'] == $pId){
            $v['child'] = getTree($data, $v['id']);
            $tree[] = $v;
        }
    }

    return $tree;
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
 * 包装商品SKU 属性返回给前端
 * @param array $tmpSpecArr
 * @return array
 */
function packGoodsSpecAttr(array $tmpSpecArr){
    foreach ($tmpSpecArr as $key1=>$tmpSpecArrVal){
        foreach ($tmpSpecArrVal as $key2=>$isCheck){
            if(!$isCheck){unset($tmpSpecArr[$key1][$key2]);}
        }
    }

    foreach ($tmpSpecArr as $specAttrName =>$specAttrVal){
        $tmpArrItem = [
            'standardListName'=>$specAttrName,
            'standardInfoList'=>[]
        ];

        foreach ($specAttrVal as $specAttrName2 =>$specAttrVal2){
            $tmpArrItem['standardInfoList'][] = [
                'standardName'=>$specAttrName2,
                'attrValueId'=>$specAttrName2,
                'isSelect'=>0
            ];
        }

        $specAttrArr[] = $tmpArrItem;
    }

    return $specAttrArr;
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