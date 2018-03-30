<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends BaseController {
	public function login(){
		$r['isOk'] = 1;
		GResult::getInstance()->echoOkAndResult($r);
	}
	public function getline(){
		$rid = I("param.rid","","trim");//记录id
		$data = M("record")->field("hrvdata,IBIdata,s_time,time_length")->where("id = '$rid'")->find();
		$time_length = $data['time_length'];
		$time_point = $time_length/0.5;
		$hrv = $data['hrvdata'];
		$hrv = ltrim($hrv,'[');
		$hrv = rtrim($hrv,']');
		$hrvdata = explode(',', $hrv);
		$ibi = $data['ibidata'];
		$ibi = ltrim($ibi,'[');
		$ibi = rtrim($ibi,']');
		$ibidata = explode(',', $ibi);
		$time = 0;
		for ($i=0; $i < $time_point; $i++) { 
			$time += 0.5;
			$hrvtime[] = $time;
		}
		$ibitime = 0;
		for ($i=0; $i < count($ibidata); $i++) { 
			$ibitime += 1;
			$ibitimes[] = $ibitime;
		}
		/*foreach ($hrvdatas as $key => $value) {
			for ($i=0; $i < count($hrvdata); $i++) { 
				$data[$i] = $hrvdata[$i];
			}
			$hrvdatas[$key]['data'] = $data[$key];
		}*/
		$hrvtime = json_encode($hrvtime,JSON_UNESCAPED_UNICODE);
		$hrvdata = json_encode($hrvdata,JSON_UNESCAPED_UNICODE);
		$ibidata = json_encode($ibidata,JSON_UNESCAPED_UNICODE);
		$ibitimes = json_encode($ibitimes,JSON_UNESCAPED_UNICODE);
		$this->assign("hrvtime",$hrvtime);
		$this->assign("hrvdata",$hrvdata);
		$this->assign("ibidata",$ibidata);
		$this->assign("ibitime",$ibitimes);
		$this->display();
	}
	public function roate(){
		$roate = M("record")->where(" user_id = 1 && id = 52")->getfield("nb");
		$to = 0;
        if ($roate > 0 && $roate < 1.15){
            if ($roate > 0 && $roate <= 0.4){
                $to = (90 - ($roate * (45 / 0.4))) * -1;
            }else if ($roate > 0.4 && $roate <= 0.8){
                $to = (90 - (($roate - 0.4) * (27 / 0.4) + 45)) * -1;
            }else if ($roate > 0.8 && nb < 1.15){
                $to = (90 - (((nb - 0.8) * (18 / 0.35)) + 72)) * -1;
            }
        }else{
            if ($roate >= 1.15 && $roate <= 1.5){
                $to = (($roate - 1.15) * (18 / 0.35));
            }else if ($roate > 1.5 && $roate <= 5){
                $to = 27 + (($roate - 1.5) * (27 / 3.5));
            }else if ($roate > 5){
                $to = 45 + (($roate - 5) * (45 / 10));
				if ($to >= 90){
                    $to = 90;
                }
            }
        }
        $this->assign("data",$to);
        $this->display();
          //  echo $to;
	}
}

