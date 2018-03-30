<?php
namespace Admin\Controller;
use Think\Controller;
class RecordmanagerController extends Controller{
	public function record(){
		        $m = M("Record");
		 $UserModel=D('user');

        $coun=$UserModel->alias('a')
            ->field("a.nickname,b.id,b.s_time,b.time_length,b.report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")
            ->join("LEFT JOIN h_record as b on a.id=b.user_id")
            ->where("a.jl_id='$_SESSION[id]'")
            ->order('b.id desc')
            ->select();

                $count  = count($coun);
                if($_SESSION['id'] !=1){
                    $count=$m->count();

           	 $Page       = new \Think\Page($count,10);
           	 $show       = $Page->show();// 分页显示输出
        $list=$UserModel->alias('a')
             ->field("a.nickname,b.id,b.s_time,b.time_length,b.report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")
            ->join("LEFT JOIN h_record as b on a.id=b.user_id")
            ->where("a.jl_id='$_SESSION[id]'")
            ->order('b.id desc')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select(); 
        }
        // var_dump($list);
//        h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex
        if($_SESSION['id']==1){
                       	 $list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                 ->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")
                 ->order('h_record.id desc')
                  ->limit($Page->firstRow.','.$Page->listRows)
                 ->select();
//           	 var_dump($list);
        }

			$sel = M('Record')
                ->distinct(true)
                ->field('timetype')
                ->select();
           	foreach ($list as $key => $v) {
	           	$time = $v['time_length'];
				if(is_numeric($time)){
				    $value = array(
				      "years" => 0, "days" => 0, "hours" => 0,
				      "minutes" => 0, "seconds" => 0,
				    );
				    if($time >= 31556926){
				      $value["years"] = floor($time/31556926);
				      $time = ($time%31556926);
				    }
				    if($time >= 86400){
				      $value["days"] = floor($time/86400);
				      $time = ($time%86400);
				    }
				    if($time >= 3600){
				      $value["hours"] = floor($time/3600);
				      $time = ($time%3600);
				    }
				    if($time >= 60){
				      $value["minutes"] = floor($time/60);
				      $time = ($time%60);
				    }
				    $value["seconds"] = floor($time);
				    $times = $value["hours"] ."小时". $value["minutes"] ."分".$value["seconds"]."秒";
				    
				}else{
				    //echo "error";
				}
				$list[$key]['time_length'] = $times;

           	}
        	$m=D('organization');
           	$group=$m->select();
      		$this->assign("group",$group);
           // /print_r($list);exit("ccc");
			$this->assign("count",$count);
			$this->assign("sel",$sel);
			$this->assign("list",$list);
			$this->assign('page',$show);// 赋值分页输出
			$this->display();
	}
	public function recordSearch(){
		$name = I('post.uname','','trim');
		$sel = I('post.sel','','trim');
		$time = I('post.time','','trim');
		$group = I('post.group','','trim');
		$m = M("Record");
		/*$n = $m->join("LEgroupOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,evaluation,hrvmark,timetype as rkind")->order('h_record.id asc')->where("h_user.nickname like '$name' || h_record.rtime like '%$time%' || timetype = '$sel'")->limit($Page->firstRow.','.$Page->listRows)->select();
            $count      = count($n);
           	$Page       = new \Think\Page($count,10);
           	$show       = $Page->show();// 分页显示输出
           	$list = $m->order('id asc')
			 ->where("name = '$name' && rkind = '$sel'")
			 ->limit($Page->firstRow.','.$Page->listRows)->select();
			$list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,evaluation,hrvmark,timetype as rkind")->order('h_record.id asc')->where("h_user.nickname like '$name' || h_record.rtime like '%$time%' || timetype = '$sel'")->limit($Page->firstRow.','.$Page->listRows)->select();
			//echo M("record")->getlastsql();
			echo $name."<br>".$sel."<br>".$time."<br>";*/
			if ($name != null && $sel == null && $time == null) {
				//echo "有名字";
				$n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where("h_user.nickname like '$name'")->limit($Page->firstRow.','.$Page->listRows)->select();
	            $count      = count($n);
	           	$Page       = new \Think\Page($count,10);
	           	$show       = $Page->show();// 分页显示输出
				$list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where("h_user.nickname like '$name' ")->limit($Page->firstRow.','.$Page->listRows)->select();
			}else if ($name == null && $sel  != null && $time == null) {
				//echo "有类型";
				$n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where(" timetype = '$sel'")->limit($Page->firstRow.','.$Page->listRows)->select();
	            $count      = count($n);
	           	$Page       = new \Think\Page($count,10);
	           	$show       = $Page->show();// 分页显示输出
				$list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where("timetype = '$sel'")->limit($Page->firstRow.','.$Page->listRows)->select();
			}else if ($name == null && $sel == null && $time != null) {
				//echo "有时间";
				$n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where(" h_record.rtime like '%$time%' ")->limit($Page->firstRow.','.$Page->listRows)->select();
	            $count      = count($n);
	           	$Page       = new \Think\Page($count,10);
	           	$show       = $Page->show();// 分页显示输出
				$list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where(" h_record.rtime like '%$time%' ")->limit($Page->firstRow.','.$Page->listRows)->select();
			}else if ($name == null && $sel == null && $time == null && $group != null ) {
				// echo "用户组";die();
				$user=D('user');
				$c = $user->alias('a')
				->where("groups='$group'")
				->join('LEFT JOIN h_record b  on a.id=b.user_id ')
				->limit($Page->firstRow.','.$Page->listRows)->select();
				->select();

			    $count      = count($c);
	           	$Page       = new \Think\Page($count,10);
	           	$show       = $Page->show();// 分页显示输出
				$list= $user->alias('a')
				->where("groups='$group'")
				->join('LEFT JOIN h_record b  on a.id=b.user_id ')
				->limit($Page->firstRow.','.$Page->listRows)
				->select();
						// $list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where(" h_record.rtime like '%$time%' ")->limit($Page->firstRow.','.$Page->listRows)->select();
			
				// ->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")
				// ->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")
				// ->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")
				// ->order('h_record.id asc')
				// ->where(" h_user.groups='$group' ")
				// ->limit($Page->firstRow.','.$Page->listRows)->select();
			
	   //          $count      = count($n);
	   //         	$Page       = new \Think\Page($count,10);
	   //         	$show       = $Page->show();// 分页显示输出
				// $list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where(" h_record.rtime like '%$time%' ")->limit($Page->firstRow.','.$Page->listRows)->select();
			}else if ($name != null && $sel  != null && $time != null) {
				$n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where("h_user.nickname like '$name' && h_record.rtime like '%$time%' && timetype = '$sel'")->limit($Page->firstRow.','.$Page->listRows)->select();
	            $count      = count($n);
	           	$Page       = new \Think\Page($count,10);
	           	$show       = $Page->show();// 分页显示输出
				$list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where("h_user.nickname like '$name' && h_record.rtime like '%$time%' && timetype = '$sel'")->limit($Page->firstRow.','.$Page->listRows)->select();
			
			}else if ($name != null && $sel  != null && $time == null) {
				//echo "名字类型";
				$n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where("h_user.nickname like '$name'  && timetype = '$sel'")->limit($Page->firstRow.','.$Page->listRows)->select();
	            $count      = count($n);
	           	$Page       = new \Think\Page($count,10);
	           	$show       = $Page->show();// 分页显示输出
				$list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where("h_user.nickname like '$name'  && timetype = '$sel'")->limit($Page->firstRow.','.$Page->listRows)->select();
			}else if ($name != null && $sel  == null && $time != null) {
				//echo "名字时间";
				$n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where("h_user.nickname like '$name' && h_record.rtime like '%$time%' ")->limit($Page->firstRow.','.$Page->listRows)->select();
	            $count      = count($n);
	           	$Page       = new \Think\Page($count,10);
	           	$show       = $Page->show();// 分页显示输出
				$list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where("h_user.nickname like '$name' && h_record.rtime like '%$time%' ")->limit($Page->firstRow.','.$Page->listRows)->select();
			}else if ($name == null && $sel  != null && $time != null) {
				//echo "类型时间";
				$n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where(" h_record.rtime like '%$time%' && timetype = '$sel'")->limit($Page->firstRow.','.$Page->listRows)->select();
	            $count      = count($n);
	           	$Page       = new \Think\Page($count,10);
	           	$show       = $Page->show();// 分页显示输出
				$list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where(" h_record.rtime like '%$time%' && timetype = '$sel'")->limit($Page->firstRow.','.$Page->listRows)->select();
			}else{
				//echo "什么都没有";
				$n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
	            $count      = count($n);
	           	$Page       = new \Think\Page($count,10);
	           	$show       = $Page->show();// 分页显示输出
				$list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,evaluation,hrvmark,timetype")->order('h_record.id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
			}

			foreach ($list as $key => $v) {
	           	$time = $v['time_length'];
				if(is_numeric($time)){
				    $value = array(
				      "years" => 0, "days" => 0, "hours" => 0,
				      "minutes" => 0, "seconds" => 0,
				    );
				    if($time >= 31556926){
				      $value["years"] = floor($time/31556926);
				      $time = ($time%31556926);
				    }
				    if($time >= 86400){
				      $value["days"] = floor($time/86400);
				      $time = ($time%86400);
				    }
				    if($time >= 3600){
				      $value["hours"] = floor($time/3600);
				      $time = ($time%3600);
				    }
				    if($time >= 60){
				      $value["minutes"] = floor($time/60);
				      $time = ($time%60);
				    }
				    $value["seconds"] = floor($time);
				    $times = $value["hours"] ."小时". $value["minutes"] ."分".$value["seconds"]."秒";
				    
				}else{
				    //echo "error";
				}
				$list[$key]['time_length'] = $times;

           	}
			$sel = M('Record')->distinct(true)->field('timetype')->select();
			$m=D('organization');
			 $group=$m->select();
      		$this->assign("group",$group);
           	//print_r($list);exit("hello");
			$this->assign("sel",$sel);
			$this->assign("count",$count);
			$this->assign("list",$list);
			$this->assign('page',$show);// 赋值分页输出
			$this->display("record");
	}
	public function recordDelet(){
		$id = I('get.id','','trim');
		$bool = M('Record')->where("id = $id")->delete();
		if($bool){
			$this->success("删除记录成功!",U('Recordmanager/record'),3);
		}else{
			$this->error("删除记录失败!");
		}
	}
	//批量删除
	public function deletesrecord(){
		$uid = I('post.test');
		if(is_array($uid)){   
		    $where = 'id in('.implode(',',$uid).')';  
		}else{  
		   $where = 'id='.$uid; 
		} 
		$bool=M("Record")->where($where)->delete();  
		if($bool){
			$this->success("用户成功被删除!");
		}else{
			$this->error("删除失败!");
		}
	}
	public function recordLook(){
		$id = I('get.id','','trim');
		$data = M('Record')->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,evaluation,hrvmark,rkind")->where("h_record.id = '$id'")->select();
		foreach ($data as $key => $v) {
	           	$time = $v['time_length'];
				if(is_numeric($time)){
				    $value = array(
				      "years" => 0, "days" => 0, "hours" => 0,
				      "minutes" => 0, "seconds" => 0,
				    );
				    if($time >= 31556926){
				      $value["years"] = floor($time/31556926);
				      $time = ($time%31556926);
				    }
				    if($time >= 86400){
				      $value["days"] = floor($time/86400);
				      $time = ($time%86400);
				    }
				    if($time >= 3600){
				      $value["hours"] = floor($time/3600);
				      $time = ($time%3600);
				    }
				    if($time >= 60){
				      $value["minutes"] = floor($time/60);
				      $time = ($time%60);
				    }
				    $value["seconds"] = floor($time);
				    $times = $value["hours"] ."小时". $value["minutes"] ."分".$value["seconds"]."秒";
				    
				}else{
				    //echo "error";
				}
				$data[$key]['time_length'] = $times;

           	}
		$this->data = $data;
		$this->display();
	}
	public function getline(){
		$rid = I("param.id","","trim");//记录id
		if (!$rid) {
			echo "error";
		}
//		echo '123';die();
		$datas = M("record")->join("LEFT JOIN h_user ON h_record.user_id = h_user.id")
            ->field("h_record.id,nickname,timetype as rkind,s_time,time_length,synthesisscore,deflatingindex,stabilityindex,pressureindex,hrvscore,evaluation,HRVmark,epdata,hrvdata,IBIdata,pulsedata,rtime,hfnorm,lfnorm,hf,lhr,lf,vlf,tp,fPNN,fSDSD,fSD,fRMSSD,fSDNN,fMean,fStdDev,report")->where("  h_record.id = '$rid'")->find();
		$time = $datas['time_length'];
		//$times = A('Base') -> Sec2Time($time);

		if(is_numeric($time)){
		    $value = array(
		      "years" => 0, "days" => 0, "hours" => 0,
		      "minutes" => 0, "seconds" => 0,
		    );
		    if($time >= 31556926){
		      $value["years"] = floor($time/31556926);
		      $time = ($time%31556926);
		    }
		    if($time >= 86400){
		      $value["days"] = floor($time/86400);
		      $time = ($time%86400);
		    }
		    if($time >= 3600){
		      $value["hours"] = floor($time/3600);
		      $time = ($time%3600);
		    }
		    if($time >= 60){
		      $value["minutes"] = floor($time/60);
		      $time = ($time%60);
		    }
		    $value["seconds"] = floor($time);
		    $times = $value["hours"] ."小时". $value["minutes"] ."分".$value["seconds"]."秒";


		}else{
		    return (bool) FALSE;
		}





		$datas['time_length'] = $times;
		$data = M("record")->field("hrvdata,IBIdata,s_time,time_length")->where("id = '$rid'")->find();
		//hrv
		$time_length = $data['time_length'];
		$time_point = $time_length/0.5;
		$hrv = $data['hrvdata'];
		$hrv = ltrim($hrv,'[');
		$hrv = rtrim($hrv,']');
		$hrvdata = explode(',', $hrv);
		$time = 0;
		for ($i=0; $i < $time_point; $i++) {
			$time += 0.5;
			$hrvtime[] = $time;
		}
		//频谱
		$ibi = $data['ibidata'];
		$ibi = ltrim($ibi,'[');
		$ibi = rtrim($ibi,']');
		$ibidata = explode(',', $ibi);
		for ($i=0; $i < count($ibidata)/2; $i++) {
			$ibidatas[] = $ibidata[$i];
		}
		$ibitime = 0;
		for ($i=0; $i < count($ibidata)/2; $i++) {
			$ibitime += 1;
			$ibitimes[] = $ibitime;
		}
		/*foreach ($hrvdatas as $key => $value) {
			for ($i=0; $i < count($hrvdata); $i++) {
				$data[$i] = $hrvdata[$i];
			}
			$hrvdatas[$key]['data'] = $data[$key];
		}*/
		$roate = M("record")->where(" id = '$rid'")->getfield("nb");

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

        $this->assign("nb",round($to,1));
		$hrvtime = json_encode($hrvtime,JSON_UNESCAPED_UNICODE);
		$hrvdata = json_encode($hrvdata,JSON_UNESCAPED_UNICODE);
		$ibidata = json_encode($ibidatas,JSON_UNESCAPED_UNICODE);
		$ibitimes = json_encode($ibitimes,JSON_UNESCAPED_UNICODE);
		$this->assign("hrvtime",$hrvtime);
		$this->assign("hrvdata",$hrvdata);
		$this->assign("ibidata",$ibidata);
		$this->assign("ibitime",$ibitimes);
		$this->assign("datas",$datas);
		$this->display();
	}
	public function aaa(){
		header("Content-type:application/vnd.ms-excel");  
   		header("Content-Disposition:attachment;filename=record.xls");
   		$id = I("param.id","","trim");
   		//echo $id;exit("id");
   		$data = M('Record')->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.*")->where("h_record.id = '$id'")->find();
   		//var_dump($data);exit();
   		if($data)
   		{
   			echo "
	<table>
		<tr>
			<th colspan='6' align='center'>HRV记录详情</th>
		</tr>
		<tr>
			<td align='right'>用户名:{$data['nickname']}</td>
			<td align='right'>记录类型:{$data['rkind']}</td>
			<td align='right'>记录时间:</td><td align='left'>{$data['s_time']}</td>
			<td align='right'>记录时长:</td><td align='left'>{$data['time_length']}</td>
		</tr>
	</table>
	<br/>
	<table>
		<tr>
			<th colspan='6'>生理数据</th>
			
		</tr>
		<tr>
			<td align='right'>M-HRT(bpm):</td><td align='left'>{$data['fmean']}</td>
			<td align='right'>SD-HRT(bpm):</td><td align='left'>{$data['fstddev']}</td>
			<td align='right'>SDNN(ms):</td><td align='left'>{$data['fsdnn']}</td>
		</tr>
		<tr>
			<td align='right'>RMMSD(ms):</td><td align='left'>{$data['frmssd']}</td>
			<td align='right'>SD(ms):</td><td align='left'>{$data['fsd']}</td>
			<td align='right'>SDSD(ms):</td><td align='left'>{$data['fsdsd']}</td>
		</tr>
		<tr>
			<td align='right'>PNN50(%):</td><td colspan='7' align='left'>{$data['fpnn']}</td>
		</tr>
		<tr>
			<td align='right'>TP(ms2):</td><td align='left'>{$data['tp']}</td>
			<td align='right'>VLF(ms2):</td><td align='left'>{$data['vlf']}</td>
			<td align='right'>LF(ms2):</td><td align='left'>{$data['lf']}</td>
		</tr>
		<tr>
			<td align='right'>HF(ms2):</td><td align='left'>{$data['hf']}</td>
			<td align='right'>LF/HF:</td><td align='left'>{$data['lhr']}</td>
			<td align='right'>LFnorm:</td><td align='left'>{$data['lfnorm']}</td>
		</tr>
		<tr>
			<td align='right'>HFnorm:</td><td colspan='7' align='left'>{$data['hfnorm']}</td>
		</tr>
	</table>
	<br/>
	<table>
		<tr>
			<th colspan='6'>心理数据</th>
			
		</tr>
		<tr>
			<td align='right'>调节指数:</td><td align='left'>{$data['deflatingindex']}</td>
			<td align='right'>HRV得分:</td><td align='left'>{$data['hrvscore']}</td>
			<td align='right'>稳定指数:</td><td align='left'>{$data['stabilityindex']}</td>
		</tr>
		<tr>
			<td align='right'>综合得分:</td><td align='left'>{$data['synthesisscore']}</td>
			<td align='right'>压力指数:</td><td align='left'>{$data['pressureindex']}</td>
			<td align='right'>平均心率:</td><td align='left'>{$data['fmean']}</td>
		</tr>
	</table>
	<br/>
	<table>
		<tr>
			<th colspan='6'>评价报告</th>
		</tr>
		<tr>
			<td colspan='6'>{$data['report']}</td>
		</tr>
	</table>";
   		}
	}


	public function recorddetail(){
		 $rid = I("param.id","","trim");//记录id
		if (!$rid) {
			echo "error";
		}
		$data = M("record")->join("LEFT JOIN h_user ON h_record.user_id = h_user.id")->field("h_record.id,nickname,s_time,time_length,synthesisscore,deflatingindex,stabilityindex,pressureindex,hrvscore,evaluation,HRVmark,epdata,hrvdata,IBIdata,pulsedata,rtime,hfnorm,lfnorm,hf,lhr,lf,vlf,tp,fPNN,fSDSD,fSD,fRMSSD,fSDNN,fMean,fStdDev,report,timetype")->where("  h_record.id = '$rid'")->find();
		$time = $data['time_length'];
		//$times = A('Base') -> Sec2Time($time);
		//print_r($data);
		//echo $time;
		if(is_numeric($time)){
		    $value = array(
		      "years" => 0, "days" => 0, "hours" => 0,
		      "minutes" => 0, "seconds" => 0,
		    );
		    if($time >= 31556926){
		      $value["years"] = floor($time/31556926);
		      $time = ($time%31556926);
		    }
		    if($time >= 86400){
		      $value["days"] = floor($time/86400);
		      $time = ($time%86400);
		    }
		    if($time >= 3600){
		      $value["hours"] = floor($time/3600);
		      $time = ($time%3600);
		    }
		    if($time >= 60){
		      $value["minutes"] = floor($time/60);
		      $time = ($time%60);
		    }
		    $value["seconds"] = floor($time);
		    $times = $value["hours"] ."小时". $value["minutes"] ."分".$value["seconds"]."秒";
		    
		    
		}else{
		    return (bool) FALSE;
		}
		$data['time_length'] = $times;
		//$data = M("record")->field("hrvdata,IBIdata,s_time,time_length")->where("id = '$rid'")->find();
        //print_r($data);exit();
		$this->assign("data",$data);
		$this->display();
	}
	public function bbb(){
		header("Content-type:application/vnd.ms-excel");  
   		header("Content-Disposition:attachment;filename=record.xls");
		$uid = I('post.test');
		if(is_array($uid)){   
		    $where = 'id in('.implode(',',$uid).')';  
		}else{  
		   $where = 'id='.$uid; 
		} 
   		$data = M('Record')->field("id,user_id,s_time,time_length,synthesisscore,deflatingindex,stabilityindex,pressureindex,hrvscore,evaluation,HRVmark,epdata,hrvdata,IBIdata,pulsedata,rtime,hfnorm,lfnorm,hf,lhr,lf,vlf,tp,fPNN,fSDSD,fSD,fRMSSD,fSDNN,fMean,fStdDev,report,timetype")->where($where)->select();
   		foreach ($data as $key => $value) {
   			$user_id = $value['user_id'];
   			$user_name = M("user")->where("id = '$user_id'")->getfield("nickname");
   			$data[$key]['nickname'] = $user_name;


   			$time = $value['time_length'];
			if(is_numeric($time)){
			    $v = array(
			      "years" => 0, "days" => 0, "hours" => 0,
			      "minutes" => 0, "seconds" => 0,
			    );
			    if($time >= 31556926){
			      $v["years"] = floor($time/31556926);
			      $time = ($time%31556926);
			    }
			    if($time >= 86400){
			      $v["days"] = floor($time/86400);
			      $time = ($time%86400);
			    }
			    if($time >= 3600){
			      $v["hours"] = floor($time/3600);
			      $time = ($time%3600);
			    }
			    if($time >= 60){
			      $v["minutes"] = floor($time/60);
			      $time = ($time%60);
			    }
			    $v["seconds"] = floor($time);
			    $times = $v["hours"] ."小时". $v["minutes"] ."分".$v["seconds"]."秒"; 
				$data[$key]['time_length'] = $times;
			}else{
			    return (bool) FALSE;
			}
   		}
   		if($data)
   		{
   			foreach ($data as $key => $value) {
   				echo "
				<table>
					<tr>
						<th colspan='6' align='center'>HRV记录详情</th>
					</tr>
					<tr>
						<td align='right'>用户名:{$value['nickname']}</td>
						<td align='right'>记录类型:{$value['rkind']}</td>
						<td align='right'>记录时间:</td><td align='left'>{$value['s_time']}</td>
						<td align='right'>记录时长:</td><td align='left'>{$value['time_length']}</td>
					</tr>
				</table>
				<br/>
				<table>
					<tr>
						<th colspan='6'>生理数据</th>
						
					</tr>
					<tr>
						<td align='right'>M-HRT(bpm):</td><td align='left'>{$value['fmean']}</td>
						<td align='right'>SD-HRT(bpm):</td><td align='left'>{$value['fstddev']}</td>
						<td align='right'>SDNN(ms):</td><td align='left'>{$value['fsdnn']}</td>
					</tr>
					<tr>
						<td align='right'>RMMSD(ms):</td><td align='left'>{$value['frmssd']}</td>
						<td align='right'>SD(ms):</td><td align='left'>{$value['fsd']}</td>
						<td align='right'>SDSD(ms):</td><td align='left'>{$value['fsdsd']}</td>
					</tr>
					<tr>
						<td align='right'>PNN50(%):</td><td colspan='7' align='left'>{$value['fpnn']}</td>
					</tr>
					<tr>
						<td align='right'>TP(ms2):</td><td align='left'>{$value['tp']}</td>
						<td align='right'>VLF(ms2):</td><td align='left'>{$value['vlf']}</td>
						<td align='right'>LF(ms2):</td><td align='left'>{$value['lf']}</td>
					</tr>
					<tr>
						<td align='right'>HF(ms2):</td><td align='left'>{$value['hf']}</td>
						<td align='right'>LF/HF:</td><td align='left'>{$value['lhr']}</td>
						<td align='right'>LFnorm:</td><td align='left'>{$value['lfnorm']}</td>
					</tr>
					<tr>
						<td align='right'>HFnorm:</td><td colspan='7' align='left'>{$value['hfnorm']}</td>
					</tr>
				</table>
				<br/>
				<table>
					<tr>
						<th colspan='6'>心理数据</th>
						
					</tr>
					<tr>
						<td align='right'>调节指数:</td><td align='left'>{$value['deflatingindex']}</td>
						<td align='right'>HRV得分:</td><td align='left'>{$value['hrvscore']}</td>
						<td align='right'>稳定指数:</td><td align='left'>{$value['stabilityindex']}</td>
					</tr>
					<tr>
						<td align='right'>综合得分:</td><td align='left'>{$value['synthesisscore']}</td>
						<td align='right'>压力指数:</td><td align='left'>{$value['pressureindex']}</td>
						<td align='right'>平均心率:</td><td align='left'>{$value['fmean']}</td>
					</tr>
				</table>
				<br/>
				<table>
					<tr>
						<th colspan='6'>评价报告</th>
					</tr>
					<tr>
						<td colspan='6'>{$value['report']}</td>
					</tr>
				</table>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "<hr>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
   			}
   			
   		}
	}
}
