<?php
namespace App\Helpers;

class SigninCalendar
{

    /**
     * 获取指定月签到日历
     * [init description]
     * @param  [type] $year   [description]
     * @param  [type] $month  [description]
     * @param  [type] $signin [description]
     * @return [type]         [description]
     */
	public function init($year,$month,$signin=[]){
		$data = [];


	    $days=date('t',strtotime("{$year}-{$month}-1"));//获取当前月有多少天
	    $week=date('w',strtotime("{$year}-{$month}-1"));//当前1号是星期几

	    if($week > 0){
	    	$upperMonth = $month -1;
	    	$upperDays  = date('t',strtotime("{$year}-{$upperMonth}-1"));
			for($i=$week-1;$i>=0;$i--){
				$data[] = ['day'=>$upperDays-$i,'class'=>'calendar-gray'];
			}
	    }

	    for($i=1;$i<=$days;$i++){
	    	$class = '';
	    	if(in_array(date('Y-m-d',strtotime("{$year}-{$month}-{$i}")), $signin)){
				$class = 'calendar-signin';
	    	}

			$data[] = ['day'=>$i,'class'=>$class];
		}

		$surplusDays = 42 - count($data);
		if($surplusDays > 0){
			for($i=1;$i<=$surplusDays;$i++){
				$data[] = ['day'=>$i,'class'=>'calendar-gray'];
			}
		}

		return $this->packing($data);
	}


	public function packing($data){
		$chunk_result = array_chunk($data, 7, true);

		$str = '<div><div class="calendar-tab-header"><div>周日</div><div>周一</div><div>周二</div><div>周三</div><div>周四</div><div>周五</div><div>周六</div></div></div><div class="calendar-tab">';
		foreach($chunk_result as $result){
			$str .= '<div class="calendar-tab-header">';
			foreach($result as $row){
				$signin = '';
				if($row["class"] == 'calendar-signin'){
					$signin = '<sub>签</sub>';
				}

				$str .= "<div class='{$row["class"]}'>{$row['day']}{$signin}</div>";
			}

			$str .= '</div>';
		}

		$str .= '</div>';
		return $str;
	}
}