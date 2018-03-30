<?php
namespace Home\Controller;
use Think\Controller;
class ApiuserrController extends BaseController {
	//登录
	public function login(){
		$student_number = I("param.student_number","","trim");//用户名
		$password = I("param.password","","trim");//密码
		if (!($student_number && $password)) {
			$r['data']['success'] = 0;
			$r['data']['message'] = "缺少参数";
			GResult::getInstance()->echoErroAndMessage($r);exit;
		}
		$is_exist = M("user")->where("student_number = '$student_number'")->getfield("id");//判断用户是否存在
		if ($is_exist) {
			$upassword = M("user")->where("student_number = '$student_number'")->getfield("password");
			if (md5($password) == $upassword) {//判断密码是否相同
				$data = M("user")->field("id,realName,student_number,weight,height,workingPlace,position,medicalHistory,mobile,birthday,sex,nickname as username,email,pic,groups as organization,companytype")->where("student_number = '$student_number'")->find();
				$user_id = M("user")->where("student_number = '$student_number'")->getfield("id");
				$hrv = M("record")->field("HRVscore")->where("user_id = '$user_id'")->select();
				if ($hrv) {
					foreach ($hrv as $key => $value) {
						$hrvscore += $value['hrvscore'];
					}
					$data['hrvscore'] = $hrvscore;//hrv得分
				}else{
					$data['hrvscore'] = 0;
				}
				
				$leida = M("radardatas")->where("user_id = '$user_id'")->select();
				if ($leida) {
					foreach ($leida as $key => $value) {
						$observe += $value['observe'];
						$rember += $value['rember'];
						$emotion += $value['emotion'];
						$thinking += $value['thinking'];
						$willpower += $value['willpower'];
					}
					//雷达的五个数据
					$data['observe'] = $observe;
					$data['rember'] = $rember;
					$data['emotion'] = $emotion;
					$data['willpower'] = $willpower;
					$data['thinking'] = $thinking;
				}else{
					$data['observe'] = 0;
					$data['rember'] = 0;
					$data['emotion'] = 0;
					$data['willpower'] = 0;
					$data['thinking'] = 0;
				}
				$data['mood'] = M("mood")->field("moodtime,moodmark,moodsocre")->where("uid = '$user_id'")->limit(1)->order("moodtime")->find();
				$r['data']['success'] = 1;
				$r['data']['userInfo'] = $data;
				$r["data"]["message"] = "登录成功";
				GResult::getInstance()->echoOkAndResult($r);exit;
			}else{
				$r['data']['success'] = 2;
				$r["data"]["message"] = "密码错误";
				GResult::getInstance()->echoOkAndResult($r);exit;
			}
		}else{
			$r['data']['success'] = 3;
			$r["data"]["message"] = "用户不存在";
			GResult::getInstance()->echoOkAndResult($r);exit;
		}
	}
	//更改密码
/*	public function editpassword(){
		$username = I("param.username","","trim");//用户名
		$oldPassword = I("param.oldPassword","","trim");//旧密码
		$newPassword = I("param.newPassword","","trim");//新密码
		if (!($username && $oldPassword && $newPassword)) {
			$r['data']['success'] = 0;
			$r['data']['message'] = "缺少参数";
			GResult::getInstance()->echoErroAndMessage($r);exit;
		}
		$is_exist = M("user")->where("nickname = '$username'")->find();//判断用户是否存在
		if ($is_exist) {
			$upassword = M("user")->where("nickname = '$username'")->getfield("password");
			if (md5($oldPassword) == $upassword) {
				$newPasswords = md5($newPassword);
				M("user")->where("nickname = '$username'")->setfield("password",$newPasswords);
				$r['data']['success'] = 1;
				$r["data"]["message"] = "修改密码成功";
				GResult::getInstance()->echoOkAndResult($r);exit;
			}else{
				$r['data']['success'] = 2;
				$r["data"]["message"] = "旧密码错误";
				GResult::getInstance()->echoOkAndResult($r);exit;
			}
		}else{
			$r['data']['success'] = 3;
			$r["data"]["message"] = "用户不存在";
			GResult::getInstance()->echoOkAndResult($r);exit;
		}
	}*/
	//修改用户信息
	public function editmessage(){
		$id = I("param.id","","trim");//用户名
		$username = I("param.username","","trim");//用户名
		$sex = I("param.sex","","trim");//性别
		$height = I("param.height","","trim");//身高
		$weight = I("param.weight","","trim");//体重
		$birthday = I("param.birthday","","trim");//生日
		$mobile = I("param.mobile","","trim");//电话
		$workingPlace = I("param.workingPlace","","trim");//工作地点
		$position = I("param.position","","trim");//职位
		$medicalHistory = I("param.medicalHistory","","trim");//病史
		$email = I("param.email","","trim");//email
		$newPassword = I("param.newPassword","","trim");//新密码
		$organization = I("param.organization","","trim");//所属组织
		$is_exist = M("user")->where(" id = '$id' ")->find();
		if (!$is_exist) {
			$r["data"]["success"] = 3;
			$r["data"]["message"] = "该用户不存在";
			GResult::getInstance()->echoErroAndMessage($r);exit;
		}else{
			if($username){           
				$data["nickname"] = $username;
			}
			if($organization){           
				$data["organization"] = $organization;
			}
			if($newPassword){           
				$newPasswords = md5($newPassword);
				$data["password"] = $newPasswords;
			}
			if($email){           //email
				$data["email"] = $email;
			}
			if($sex){           //性别
				$data["sex"] = $sex;
			}
			if($height){           //身高
				$data["height"] = $height;
			}
			if($weight){           //体重
				$data["weight"] = $weight;
			}
			if($birthday){           //生日
				$data["birthday"] = $birthday;
			}
			if($mobile){           //电话
				$data["mobile"] = $mobile;
			}
			if($workingPlace){           //工作地点
				$data["workingPlace"] = $workingPlace;
			}
			if($position){           //职位
				$data["position"] = $position;
			}
			if($medicalHistory){           //病史
				$data["medicalHistory"] = $medicalHistory;
			}
			
			if(!($data && $id)){
				$r["data"]["success"] = 0;
				$r["data"]["message"] = "缺少参数";
				GResult::getInstance()->echoErroAndMessage($r);exit;
			}
			$re = M("user")->where("id = '$id'")->save($data);
			if ($re) {
				$r['data']['success'] = 1;
				$r["data"]["message"] = "修改成功";
				GResult::getInstance()->echoOkAndResult($r);exit;
			}else{
				$r['data']['success'] = 2;
				$r["data"]["message"] = "修改失败";
				GResult::getInstance()->echoOkAndResult($r);exit;
			}
			
		}
		
	}
	//用户权限
	public function indexautho(){
		$id = I("param.id","","trim");//用户名
		if (!($id)) {
			$r['data']['success'] = 0;
			$r['data']['message'] = "缺少参数";
			GResult::getInstance()->echoErroAndMessage($r);exit;
		}
		$bigdata = M("fenlei")->field("id,name")->where("fid = 0")->select();
		$seconddata1 = M("fenlei")->field("id,name")->where("fid = 1")->select();
		$seconddata2 = M("fenlei")->field("id,name")->where("fid = 2")->select();
		$seconddata3 = M("fenlei")->field("id,name")->where("fid = 3")->select();
		$seconddata4 = M("fenlei")->field("id,name")->where("fid = 4")->select();
		$seconddata5 = M("fenlei")->field("id,name")->where("fid = 5")->select();
		$seconddata6 = M("fenlei")->field("id,name")->where("fid = 43")->select();
		$seconddata7 = M("fenlei")->field("id,name")->where("fid = 44")->select();
		$seconddata8 = M("fenlei")->field("id,name")->where("fid = 6")->select();
		$seconddata9 = M("fenlei")->field("id,name")->where("fid = 7")->select();
		$seconddata10 = M("fenlei")->field("id,name")->where("fid = 8")->select();
		$seconddata11 = M("fenlei")->field("id,name")->where("fid = 9")->select();
		$seconddata12 = M("fenlei")->field("id,name")->where("fid = 12")->select();
		$group = M("user")->where("id = '$id'")->getfield("groups");
		$js = M("organization")->where("name = '$group'")->getfield("js_name");
		$autho = M("js")->where("name = '$js'")->getfield("fid");
		//$autho = M("user")->join("LEFT JOIN h_js as js ON js.name = h_user.identity")->where("h_user.id = '$id'")->getfield("js.fid");
		$fenlei = explode(",", $autho);
		foreach ($bigdata as $key => $value) {
			if (in_array($value['id'], $fenlei)){//指标趋势权限
			 	$bigdata[$key]['is_is'] = 1;//有权限
			}else{
			 	$bigdata[$key]['is_is'] = 2;//没有权限
			}
		}
		$bigdata[0][] = $seconddata1;
		$bigdata[0][0][0][] = $seconddata8;
		$bigdata[0][0][1][] = $seconddata9;
		$bigdata[0][0][2][] = $seconddata10;
		$bigdata[0][0][3][] = $seconddata11;
		foreach ($bigdata[0][0] as $key => $value) {
			if (in_array($value['id'], $fenlei)){//指标趋势权限
			 	$bigdata[0][0][$key]['is_is'] = 1;//有权限
			}else{
			 	$bigdata[0][0][$key]['is_is'] = 2;//没有权限
			}
		}
		foreach ($bigdata[0][0][0][0] as $key => $value) {
			if (in_array($value['id'], $fenlei)){//指标趋势权限
			 	$bigdata[0][0][0][0][$key]['is_is'] = 1;//有权限
			}else{
			 	$bigdata[0][0][0][0][$key]['is_is'] = 2;//没有权限
			}
		}
		foreach ($bigdata[0][0][1][0] as $key => $value) {
			if (in_array($value['id'], $fenlei)){//指标趋势权限
			 	$bigdata[0][0][1][0][$key]['is_is'] = 1;//有权限
			}else{
			 	$bigdata[0][0][1][0][$key]['is_is'] = 2;//没有权限
			}
		}
		foreach ($bigdata[0][0][2][0] as $key => $value) {
			if (in_array($value['id'], $fenlei)){//指标趋势权限
			 	$bigdata[0][0][2][0][$key]['is_is'] = 1;//有权限
			}else{
			 	$bigdata[0][0][2][0][$key]['is_is'] = 2;//没有权限
			}
		}
		foreach ($bigdata[0][0][3][0] as $key => $value) {
			if (in_array($value['id'], $fenlei)){//指标趋势权限
			 	$bigdata[0][0][3][0][$key]['is_is'] = 1;//有权限
			}else{
			 	$bigdata[0][0][3][0][$key]['is_is'] = 2;//没有权限
			}
		}
		$bigdata[1][] = $seconddata2;
		foreach ($bigdata[1][0] as $key => $value) {
			if (in_array($value['id'], $fenlei)){//指标趋势权限
			 	$bigdata[1][0][$key]['is_is'] = 1;//有权限
			}else{
			 	$bigdata[1][0][$key]['is_is'] = 2;//没有权限
			}
		}
		$bigdata[2][] = $seconddata3;
		$bigdata[2][0][0][] = $seconddata6;
		$bigdata[2][0][1][] = $seconddata7;
		foreach ($bigdata[2][0] as $key => $value) {
			if (in_array($value['id'], $fenlei)){//指标趋势权限
			 	$bigdata[2][0][$key]['is_is'] = 1;//有权限
			}else{
			 	$bigdata[2][0][$key]['is_is'] = 2;//没有权限
			}
		}
		foreach ($bigdata[2][0][0][0] as $key => $value) {
			if (in_array($value['id'], $fenlei)){//指标趋势权限
			 	$bigdata[2][0][0][0][$key]['is_is'] = 1;//有权限
			}else{
			 	$bigdata[2][0][0][0][$key]['is_is'] = 2;//没有权限
			}
		}
		foreach ($bigdata[2][0][1][0] as $key => $value) {
			if (in_array($value['id'], $fenlei)){//指标趋势权限
			 	$bigdata[2][0][1][0][$key]['is_is'] = 1;//有权限
			}else{
			 	$bigdata[2][0][1][0][$key]['is_is'] = 2;//没有权限
			}
		}
		$bigdata[3][] = $seconddata4;
		foreach ($bigdata[3][0] as $key => $value) {
			if (in_array($value['id'], $fenlei)){//指标趋势权限
			 	$bigdata[3][0][$key]['is_is'] = 1;//有权限
			}else{
			 	$bigdata[3][0][$key]['is_is'] = 2;//没有权限
			}
		}
		$bigdata[4][] = $seconddata5;
		$bigdata[4][0][2][] = $seconddata12;
		foreach ($bigdata[4][0] as $key => $value) {
			if (in_array($value['id'], $fenlei)){//指标趋势权限
			 	$bigdata[4][0][$key]['is_is'] = 1;//有权限
			}else{
			 	$bigdata[4][0][$key]['is_is'] = 2;//没有权限
			}
		}
		foreach ($bigdata[4][0][2][0] as $key => $value) {
			if (in_array($value['id'], $fenlei)){//指标趋势权限
			 	$bigdata[4][0][2][0][$key]['is_is'] = 1;//有权限
			}else{
			 	$bigdata[4][0][2][0][$key]['is_is'] = 2;//没有权限
			}
		}
		
		/*$authos = array();
		for($index=0;$index<count($fenlei);$index++) 
		{ 
			$fenlei_id = $fenlei[$index];
			$authos[] = M("fenlei")->field("id,name,fid")->where("id = '$fenlei_id'")->find();
		} */
		$r['data']['data'] = $bigdata;
		$r['data']['success'] = 1;
		$r["data"]["message"] = "请求成功";
		GResult::getInstance()->echoOkAndResult($r);exit;
	}
	//停止记录
	public function stoprecord(){
		
		$type = I("param.type","","trim");// 1 监测记录  2 训练记录  3 放松记录
		$user_id = I("param.id","","trim");//用户id
		$hrvdata = I("param.hrvdata","","trim");//HRV数据
		$epdata = I("param.epdata","","trim");//ep数据
		$ppgdata = I("param.IBIdata","","trim");//频谱数据
		$pulsedata = I("param.pulsedata","","trim");//脉搏数据
		$rkind = I("param.rkind","","trim");//训练类型
		$s_time = I("param.s_time","","trim");//开始时间
		$time_length = I("param.time_length","","trim");//检测时间
		$synthesisscore = I("param.synthesisscore","","trim");//综合得分
		$deflatingindex = I("param.deflatingindex","","trim");//调节指数
		$stabilityindex = I("param.stabilityindex","","trim");//稳定指数
		$pressureindex = I("param.pressureindex","","trim");//压力指数
		$HRVscore = I("param.HRVscore","","trim");//HRV得分
		$evaluation = I("param.evaluation","","trim");//评价
		$HRVmark = I("param.HRVmark","","trim");//用户备注
		if (!($user_id && $type)) {
			$r['data']['success'] = 0;
			$r['data']['message'] = "缺少参数";
			GResult::getInstance()->echoErroAndMessage($r);exit;
		}
		$param['type'] = $type;
		$param['user_id'] = $user_id;
		$param['hrvdata'] = $hrvdata;
		$param['epdata'] = $epdata;
		$param['IBIdata'] = $ppgdata;
		$param['pulsedata'] = $pulsedata;
		$param['rkind'] = $rkind;
		$param['s_time'] = $s_time;
		$param['time_length'] = $time_length;
		$param['synthesisscore'] = $synthesisscore;
		$param['deflatingindex'] = $deflatingindex;
		$param['stabilityindex'] = $stabilityindex;
		$param['pressureindex'] = $pressureindex;
		$param['HRVscore'] = $HRVscore;
		$param['evaluation'] = $evaluation;
		$param['HRVmark'] = $HRVmark;
		$param['rtime'] = date('Y-m-d H:i:s');
		$param['NB'] = I("param.NB","","trim");//偏转神经兴奋性的指针
		$param['fMean'] = I("param.fMean","","trim");//平均心率
		$param['fStdDev'] = I("param.fStdDev","","trim");//即时心率的标准差
		$param['fSDNN'] = I("param.fSDNN","","trim");//SDNN心跳间隔的标准差
		$param['fRMSSD'] = I("param.fRMSSD","","trim");//极低频分量float类型¨
		$param['fSD'] = I("param.fSD","","trim");//低频分量float类型
		$param['fSDSD'] = I("param.fSDSD","","trim");//高频分量,float类型¨ª
		$param['fPNN'] = I("param.fPNN","","trim");//低频高频比,float类型¨ª
		$param['tp'] = I("param.tp","","trim");//
		$param['vlf'] = I("param.vlf","","trim");//极低频¦
		$param['lf'] = I("param.lf","","trim");//低频
		$param['hf'] = I("param.hf","","trim");//高频
		$param['lhr'] = I("param.lhr","","trim");//高低频比
		$param['lfnorm'] = I("param.lfnorm","","trim");///归一化低频分量
		$param['hfnorm'] = I("param.hfnorm","","trim");//归一化高频分量
		$param['left '] = I("param.left ","","trim");//频谱左侧部分
		$param['right'] = I("param.right","","trim");//频谱右侧部分
		$param['lrr'] = I("param.lrr","","trim");//频谱左右比例
		$param['RecordType'] = I("param.RecordType","","trim");//监测类型
		$param['trid'] = I("param.trid","","trim");//
		$param['tid'] = I("param.tid","","trim");//
		$param['gate'] = I("param.gate","","trim");//
		$param['diff'] = I("param.diff","","trim");//
		$param['FreData'] = I("param.FreData","","trim");//
		$param['Level'] = I("param.Level","","trim");//
		$param['TimeLength '] = I("param.TimeLength ","","trim");//
		$param['Report'] = I("param.Report","","trim");//
		$param['HeartVitalityUpper'] = I("param.HeartVitalityUpper","","trim");//
		$param['HeartVitalityDowner'] = I("param.HeartVitalityDowner","","trim");//
		$param['TimeType'] = I("param.TimeType","","trim");//HRV 检测时间类型
		$param['EndTime'] = I("param.EndTime","","trim");//结束时间
		$param['Mood'] = I("param.Mood","","trim");//工作心理

		$params['observe'] = I("param.observe","","trim");//
		$params['rember'] = I("param.rember","","trim");//
		$params['emotion'] = I("param.emotion","","trim");//
		$params['willpower'] = I("param.willpower","","trim");//
		$params['thinking'] = I("param.thinking","","trim");//
		$params['user_id'] = $user_id;
		$params['ctime'] = date("Y-m-d H:i:s");//
		
		$re = M("radardatas")->add($params);
		//$datas = M("radardatas")->where(" id = '$re' ")->find();
		$hrv = M("record")->field("HRVscore")->where("user_id = '$user_id'")->select();
		

		/*foreach ($hrv as $key => $value) {
			$hrvscore += $value['hrvscore'];
		}*/
		
		$retu = M("record")->add($param);
		

		$data = M("record")->where("user_id = '$user_id'")->order("id desc")->find();
		$leida = M("radardatas")->where("user_id = '$user_id'")->select();
				foreach ($leida as $key => $value) {
					$observe += $value['observe'];
					$rember += $value['rember'];
					$emotion += $value['emotion'];
					$thinking += $value['thinking'];
					$willpower += $value['willpower'];
				}
				//雷达的五个数据
				$data['observe'] = $observe;
				$data['rember'] = $rember;
				$data['emotion'] = $emotion;
				$data['willpower'] = $willpower;
				$data['thinking'] = $thinking;
		//print_r($data);exit();
		if ($retu) {
			$r['data']['data'] = $data;
			$r['data']['success'] = 1;
			$r["data"]["message"] = "请求成功";
			GResult::getInstance()->echoOkAndResult($r);exit;
		}else{
			$r['data']['success'] = 0;
			$r['data']['message'] = "请求失败";
			GResult::getInstance()->echoOkAndResult($r);exit;
		}
	}

	//记录列表
	public function getrecord(){
		$user_id = I("param.user_id","","trim");//用户名
		$type = I("param.type","","trim");// 1 监测记录  2 训练记录  3 放松记录
		//$pageNum = I("param.pageNum","","trim");//数据开始id
		if (!($user_id && $type)) {
			$r['data']['success'] = 0;
			$r['data']['message'] = "缺少参数";
			GResult::getInstance()->echoErroAndMessage($r);exit;
		}
		//权限
		$autho = M("user")->join("LEFT JOIN h_js as js ON js.name = h_user.identity")->where("h_user.id = '$user_id'")->getfield("js.fid");
		//echo $autho;
		if (in_array("39", $autho)){//指标趋势权限
		 	$fen['indextrend'] = 1;//有权限
		}else{
		 	$fen['indextrend'] = 2;//没有权限
		}
		if (in_array("40", $autho)){//导出记录权限
		 	$fen['export'] = 1;//有权限
		}else{
		 	$fen['export'] = 2;//没有权限
		}
		if (in_array("41", $autho)){//筛选记录权限
		 	$fen['screen'] = 1;//有权限
		}else{
		  	$fen['screen'] = 2;//没有权限
		}
		$recordInfo = M("record")
						/*->field("id,rkind,s_time,time_length,synthesisscore,deflatingindex,stabilityindex,pressureindex,HRVscore,evaluation")*/
						->where("user_id = '$user_id' && type = '$type'")
						//->limit($pageNum,10)
						->order("id desc")
						->select();
		$r['data']['data'] = $recordInfo;
		$r['data']['autho'] = $fen;
		$r['data']['success'] = 1;
		$r["data"]["message"] = "请求成功";
		GResult::getInstance()->echoOkAndResult($r);exit;
	}
	//记录详情
	public function recorddetail(){
		$user_id = I("param.user_id","","trim");//用户id
		$r_id = I("param.r_id","","trim");//记录id
		if (!($user_id && $r_id)) {
			$r['data']['success'] = 0;
			$r['data']['message'] = "缺少参数";
			GResult::getInstance()->echoErroAndMessage($r);exit;
		}
		$datas = M("record")->join("LEFT JOIN h_user ON h_record.user_id = h_user.id")->field("nickname,rkind,s_time,time_length,synthesisscore,deflatingindex,stabilityindex,pressureindex,hrvscore,evaluation,HRVmark,epdata,hrvdata,IBIdata,pulsedata,NB,fMean,fStdDev,fSDNN,fRMSSD,fSD,fSDSD,fPNN,tp,vlf,lf,hf,lhr,lfnorm,hfnorm,left,right,lrr,trid,tid,gate,diff,FreData,Level,TimeLength,Report,RecordType")->where(" h_record.user_id = '$user_id' && h_record.id = '$r_id'")->find();
		$r['data']['datas'] = $datas;
		$r['data']['success'] = 1;
		$r["data"]["message"] = "请求成功";
		GResult::getInstance()->echoOkAndResult($r);exit;
	}
	//删除记录
	public function deleterecord(){
		$r_id = I("param.r_id","","trim");//记录id
		$user_id = I("param.user_id","","trim");//用户id
		if (!($r_id && $user_id)) {
			$r['data']['success'] = 0;
			$r['data']['message'] = "缺少参数";
			GResult::getInstance()->echoErroAndMessage($r);exit;
		}
		$str = rtrim($r_id,',');
		$arr = explode(',', $str);
		foreach ($arr as $key => $value) {
			$rid = $arr[$key];
			$re = M("record")->where("id = '$rid' && user_id = '$user_id' ")->delete();
			
		}
		if ($re) {
				$r['data']['success'] = 1;
				$r["data"]["message"] = "删除成功";
				GResult::getInstance()->echoOkAndResult($r);exit();
			}else{
				$r['data']['success'] = 1;
				$r["data"]["message"] = "删除失败";
				GResult::getInstance()->echoOkAndResult($r);exit();
			}
		
	}
	//雷达图
	public function radardatas(){
		$data['user_id'] = I("param.user_id","","trim");//用户名
		$data['observe'] = I("param.observe","","trim");//
		$data['rember'] = I("param.rember","","trim");//
		$data['emotion'] = I("param.emotion","","trim");//
		$data['willpower'] = I("param.willpower","","trim");//
		$data['thinking'] = I("param.thinking","","trim");//
		$data['ctime'] = date("Y-m-d H:i:s");//
		if (!($data['user_id'])) {
			$r['data']['success'] = 0;
			$r['data']['message'] = "缺少参数";
			GResult::getInstance()->echoErroAndMessage($r);exit;
		}
		$re = M("radardatas")->add($data);
		$data = M("radardatas")->where(" id = '$re' ")->find();

		$user_id = $data['user_id'];
		$hrv = M("record")->field("HRVscore")->where("user_id = '$user_id'")->select();

		foreach ($hrv as $key => $value) {
			$hrvscore += $value['hrvscore'];
		}
		$data['hrvscore'] = $hrvscore;//hrv得分

		if ($re) {
			$r['data']['data'] = $data;
			$r['data']['success'] = 1;
			$r["data"]["message"] = "请求成功";
			GResult::getInstance()->echoOkAndResult($r);exit;
		}
	}
	//公告
	public function noticeboard(){
		$data = M("gonggao")->field("content")->limit(1)->order("ctime desc")->select();
		$r['data']['data'] = $data;
		$r['data']['success'] = 1;
		$r["data"]["message"] = "请求成功";
		GResult::getInstance()->echoOkAndResult($r);exit;
	}

	//二维码生成
	public function qrcode(){
		$rid = I("param.rid","","trim");//记录id
		if (!($rid)) {
			$r['data']['success'] = 0;
			$r['data']['message'] = "缺少参数";
			GResult::getInstance()->echoErroAndMessage($r);exit;
		}
		$text = M("record")->where("id = '$rid'")->find();
		$param = http_build_query($text);
		$url = str_replace("&","%26",$param);
		//echo $url;
		//exit();
		$urls = 'http://qr.liantu.com/api.php?&w=200&text='.$url;
		$this->assign("url",$urls);
		$this->display();
	}
	public function detail(){
		$user_id = I("param.user_id","","trim");//用户id
		$r_id = I("param.r_id","","trim");//记录id
		if (!($user_id && $r_id)) {
			$r['data']['success'] = 0;
			$r['data']['message'] = "缺少参数";
			GResult::getInstance()->echoErroAndMessage($r);exit;
		}
		$datas = M("record")->join("LEFT JOIN h_user ON h_record.user_id = h_user.id")->field("nickname,rkind,s_time,time_length,synthesisscore,deflatingindex,stabilityindex,pressureindex,hrvscore,evaluation,HRVmark,epdata,hrvdata,IBIdata,pulsedata,rtime")->where(" h_record.user_id = '$user_id' && h_record.id = '$r_id'")->find();

		/*$this->assign("times",$times);
		$this->assign("Eps",$Eps);*/
		$this->assign("data",$datas);
		$this->display();
	}
	public function getline(){
		$user_id = I("param.user_id","","trim");//用户id
		$rid = I("param.rid","","trim");//记录id
		if (!($user_id && $rid)) {
			$r['data']['success'] = 0;
			$r['data']['message'] = "缺少参数";
			GResult::getInstance()->echoErroAndMessage($r);exit;
		}
		$datas = M("record")->join("LEFT JOIN h_user ON h_record.user_id = h_user.id")->field("nickname,timetype,s_time,time_length,synthesisscore,deflatingindex,stabilityindex,pressureindex,hrvscore,evaluation,HRVmark,epdata,hrvdata,IBIdata,pulsedata,rtime,hfnorm,lfnorm,hf,lhr,lf,vlf,tp,fPNN,fSDSD,fSD,fRMSSD,fSDNN,fMean,fStdDev,report")->where(" h_record.user_id = '$user_id' && h_record.id = '$rid'")->find();
		$time = $datas['time_length'];
		$times = A('Base') -> Sec2Time($time);
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
		$roate = M("record")->where(" user_id = '$user_id' && id = '$rid'")->getfield("nb");
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

	//记录心情
	public function mood(){
		$user_id = I("param.user_id","","trim");//用户id
		$data['moodsocre'] = I("param.moodsocre","","trim");//心情分数
		$data['moodmark'] = I("param.moodremark","","trim");//心情备注
		$data['moodtime'] = date('Y-m-d H:i:s');//心情时间
		//print_r($data);exit("hello ");
		if (!($user_id && $data)) {
			$r['data']['success'] = 0;
			$r['data']['message'] = "缺少参数";
			GResult::getInstance()->echoErroAndMessage($r);exit;
		}
		$data['uid'] = $user_id;
		$re = M("mood")->add($data);
		$result = M("mood")->field("moodtime,moodmark,moodsocre")->where("id = '$user_id'")->select();
		if ($re) {
			$r['data']['success'] = 1;
			$r["data"]["message"] = "请求成功";
			GResult::getInstance()->echoOkAndResult($r);exit;
		}else{
			$r['data']['success'] = 1;
			$r["data"]["message"] = "请求失败";
			GResult::getInstance()->echoOkAndResult($r);exit;
		}
	}
	//心情列表
	public function moodlist(){
		$user_id = I("param.user_id","","trim");//用户id
		$time = I("param.time","","trim");//用户id
		//print_r($data);exit("hello ");
		if (!($user_id)) {
			$r['data']['success'] = 0;
			$r['data']['message'] = "缺少参数";
			GResult::getInstance()->echoErroAndMessage($r);exit;
		}
		if ($time) {
			$result = M("mood")->field("moodtime,moodmark,moodsocre")->where("uid = '$user_id' && moodtime like '%$time%'")->select();
		}else{
			$result = M("mood")->field("moodtime,moodmark,moodsocre")->where("uid = '$user_id'")->select();
		}
		
		$r['data']['result'] = $result;
		$r['data']['success'] = 1;
		$r["data"]["message"] = "请求成功";
		GResult::getInstance()->echoOkAndResult($r);exit;
		
	}
}
/*
生成角度图
private void MathAngle(double nb)
{
    double to = 0;
    if (nb > 0 && nb < 1.15)
    {
        if (nb > 0 && nb <= 0.4)
        {
            to = (90 - (nb * (45 / 0.4))) * -1;
        }
        else if (nb > 0.4 && nb <= 0.8)
        {
            to = (90 - ((nb - 0.4) * (27 / 0.4) + 45)) * -1;
        }
        else if (nb > 0.8 && nb < 1.15)
        {
            to = (90 - (((nb - 0.8) * (18 / 0.35)) + 72)) * -1;
        }
    }
    else
    {
        if (nb >= 1.15 && nb <= 1.5)
        {
            to = ((nb - 1.15) * (18 / 0.35));
        }
        else if (nb > 1.5 && nb <= 5)
        {
            to = 27 + ((nb - 1.5) * (27 / 3.5));
        }
        else if (nb > 5)
        {
            to = 45 + ((nb - 5) * (45 / 10));

            if (to >= 90)
            {
                to = 90;
            }
        }
    }
    this.myAngle.Angle = to;
}*/
