<?php    
//方法
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
	//返回个人信息
	public function getuserinfow($user_id){
		$userinfo = M("user")->field("t_user.nickname,t_user.pic")->where("id = '$user_id'")->find();
		return $userinfo;
	}
	//判断学豆是否够用
	public function isbean($user_id,$sub_id){
		$sbean = M("user")->where("id = '$user_id'")->getField("bean");
		$bean = M("sub")->where("sub_id = '$sub_id'")->find();
		$hbean = $bean["price"];
		if($hbean > $sbean){
			return false;
		}else{
			return $bean;
		}
	}
	//个人信息
	public function gereninfo($buser_id,$user_id){
		$fri_num = M("attention")->where("(user_id = '$buser_id' && type = 2) || ( buser_id = '$buser_id' && type = 2)")->count();   //好友数
		$user = M("user")->field("t_user.pic,t_user.nickname,t_user.sex,t_user.myname,t_user.ctime,t_school.region_name,t_gread.gread_name")->join("t_school ON t_school.region_id = t_user.school_id")->join("t_gread ON t_gread.gread_id = t_user.gread_id")->where("t_user.id = '$buser_id'")->find();                                       //个人信息
		$point = M("point")->field("t_fenlei.pic,t_point.level")->join("t_fenlei ON t_fenlei.id = t_point.fenlei_id")->where("t_point.uid = '$buser_id'")->select();  //他的圈子
		$user["quan"] = $point?$point:array();
		$article = M("article")->field("content,pic,ctime,id as article_id")->where("uid = '$buser_id' && is_delete = 2")->order("ctime desc")->limit(1)->find(); //最新一个话题
		$article["article_num"] = M("article")->where("is_delete = 2 && uid = '$buser_id'")->count();    //话题数
		$article_id = $article["article_id"];
		$article["ctime"] = $this->gettimepoor($article["ctime"]);
		$article["comment_num"] = M("comment")->where("is_delete = 2 && aid = '$article_id'")->count();
		$user["article"] = $article;    //他的话题
		//判断是否关注
		$attention = M("attention")->where("(user_id = '$user_id' && buser_id = '$buser_id') || (user_id = '$buser_id' && buser_id = '$user_id')")->find();
		if($attention){
			if($attention["type"] == 1){
				if($attention["buser_id"] == $user_id){
					$type = "2";                //单向被动关注
				}else{
					$type = "1";           
				}
			}else{
				if($attention["type"] == 2){
					$type = "1";  
				}else{
					if($attention["type"] == 3){
						if($val["buser_id"] == $user_id){
							$type = "1";                //单向主动关注
						}else{
							$type = "2";           
						}
					}else{
						$type = "2";  
					}
				}
			}
		}else{
			$type = "2";  
		}
		$user["isattention"] = $type;
		if($user_id){
			$attention = M("attention")->where("(user_id = '$user_id' && buser_id = '$buser_id') || (user_id = '$buser_id' && buser_id = '$user_id')")->find();
			if($attention){
				if($buser_id == $attention["user_id"]){
					$user["remark"] = $attention["u_remark"];
				}else{
					if($buser_id == $attention["buser_id"]){
						$user["remark"] = $attention["bu_remark"];
					}
				}
			}else{
				$user["remark"] = "";
			}
		}
		$ctime = $user["ctime"];
		$day = ceil((time() - $ctime)/(24*3600));
		$user["ctime"] = $day;     //天
		$user["fri_num"] = $fri_num;
		return $user;
	}
	//判断是否关注,并处理
	public function isattention($user_id,$buser_id){
		$attention = M("attention")->where("(user_id = '$user_id' && buser_id = '$buser_id') || (user_id = '$buser_id' && buser_id = '$user_id')")->find();
		$is = -1;
		if($attention){
			$type = $attention["type"];
			if($type == 2){
				if($user_id == $attention["user_id"]){   //正向
					$attention["type"] = 3;
				}else{
					if($user_id == $attention["buser_id"]){   //逆向
						$attention["type"] = 1;
					}
				}
			}else{
				if($type == 1){
					if($user_id == $attention["user_id"]){   //正向
						$attention["type"] = 4;
					}else{
						if($user_id == $attention["buser_id"]){   //逆向
							$attention["type"] = 2;
							$is = 1;
						}
					}
				}else{
					if($type == 3){
						if($user_id == $attention["user_id"]){   //正向
							$attention["type"] = 2;
							$is = 1;
						}else{
							if($user_id == $attention["buser_id"]){   //逆向
								$attention["type"] = 4;
							}
						}
					}else{
						if($type == 4){
							if($user_id == $attention["user_id"]){   //正向
								$attention["type"] = 1;
								$is = 1;
							}else{
								if($user_id == $attention["buser_id"]){   //逆向
									$attention["type"] = 3;
									$is = 1;
								}
							}
						}
					}
				}
			}
			$re = M("attention")->where("(user_id = '$user_id' && buser_id = '$buser_id') || (user_id = '$buser_id' && buser_id = '$user_id')")->save($attention);
			if($is == 1){
				$this->addcirclenews($user_id,$buser_id,"1");
			}
			return $re?true:false;
		}else{
			$attention["type"] = 1;
			$attention["user_id"] = $user_id;
			$attention["buser_id"] = $buser_id;
			$re = M("attention")->where("attention_id = '$attention_id'")->add($attention);
			$this->addcirclenews($user_id,$buser_id,"1");
			return $re?true:false;
		}
	}
	//添加圈子消息
	public function addcirclenews($user_id,$buser_id,$type,$con,$aid = 0,$replay_id = 0){
		$time = time();
		if($user_id == $buser_id){
			return;
		}
		$bnickname = M("user")->where("id = '$user_id'")->getField("nickname");
		if($type == 1){
			$content = $bnickname."关注了你";
		}
		elseif($type == 2){
			$content = $bnickname.'在"'.$con.'"回复了你';
		}
		elseif($type == 3){
			$content = $bnickname.'在"'.$con.'"@了你';
		}
		elseif($type == 4){
			$content = $bnickname.'在"'.$con.'"回复了你';
		}
		$data["content"] = $content;
		$data["user_id"] = $buser_id;
		$data["buser_id"] = $user_id;
		$data["aid"] = $aid;
		$data["replay_id"] = $replay_id;
		$data["is_read"] = "2";
		$data["add_time"] = $time;
		$data["type"] = $type;
		$re = M("circle_news")->add($data);
		return $re;
	}
	//今日是否签到
	public function issign($user_id,$fenlei_id){
		$time = time();
		$sign_time = M("point")->where("uid = '$user_id' && fenlei_id = '$fenlei_id' && state = 1")->getField("sign_time");
		if(!$sign_time){
			return "3";
		}
		if(date("Ymd",$time) == date("Ymd",$sign_time)){
			return "1";
		}else{
			return "2";
		}
	}
	//返回排名的具体信息
	public function orderinfo($pointinfo){
		foreach($pointinfo as $k=>$val){
			$user_id = $val["uid"];
			$pointinfo[$k]["tie"]["jing"] = M("article")->where("uid = '$user_id' && is_essential = 1 && is_delete = 2")->count();
			$pointinfo[$k]["tie"]["fa"] = M("article")->where("uid = '$user_id' && is_delete = 2")->count();
			$pointinfo[$k]["tie"]["hui"] = M("comment")->where("uid = '$user_id' && is_delete = 2")->count();
		};
		return $pointinfo;
	}
	//得到lou_id
	public function getlou_id($replay_id){
		$comment = M("comment")->field("id,replay")->where("id = '$replay_id'")->find();
		if($comment["replay"] != 0){
			$id = $this->getlou_id($comment["replay"]);
		}else{
			return $comment["id"];
		}
		return $id;
	}
	//给回复的人发圈消息
	public function faquanxiaoxi($user_id,$replay_id){
		$info = M("comment")->field("uid,content")->where("id = '$replay_id'")->find();
		$buser_id = $info["uid"];
		$con = mb_substr($info["content"], 0, 10, 'utf-8'); 
		$this->addcirclenews($user_id,$buser_id,"4",$con,"",$replay_id);
	}
	//给发帖子的人发圈消息
	public function faquanxiaoxit($user_id,$article_id){
		$info = M("article")->where("id = '$article_id'")->find();
		$buser_id = $info["uid"];
		$con = mb_substr($info["content"], 0, 10, 'utf-8'); 
		$this->addcirclenews($user_id,$buser_id,"2",$con,$article_id);
	}
	//给@的用户发圈消息
	public function faquanxiaoxig($user_id,$userids,$content,$aid){
		$con = mb_substr($content, 0, 10, 'utf-8');
		$arr = explode(",",$userids);
		foreach($arr as $val){
			$this->addcirclenews($user_id,$val,"3",$con,$aid);
		}
	}
	//回复内容
	public function fenlei($comment,$fenlei_id,$article_id,$type,$total=0,$replay_id){
		//$arr = array();
		if($type == 2){
			$rcomment = M("comment")->field("id as replay_id,content,uid,replay,ctime,lou_id")->where("lou_id = '$replay_id' && replay <> 0 && is_delete = 2")->limit($total,3)->order("ctime")->select();
		}else{
			$rcomment = M("comment")->field("id as replay_id,content,uid,replay,ctime,lou_id")->where("aid = '$article_id' && replay <> 0 && is_delete = 2")->select();
		}
		foreach($comment as $k=>$v){
			$v["user"] = $this->tieuser($v["user_id"],$fenlei_id);
			$v["ctime"] = $this->gettimepoor($v["ctime"]);
			$arr[$k] = $v;
			$is = "";
			foreach($rcomment as $key=>$val){
				if($v["replay_id"] == $val["lou_id"]){
					$val["replay_nickname"] = $this->getnickname($val["replay"]);
					$val["user"] = $this->tieuser($val["uid"],$fenlei_id);
					$val["ctime"] = $this->gettimepoor($val["ctime"]);
					$is[] = $val;
				}
				if(count($is) == 2 && $type == 1)break;
			}
			$arr[$k]["num"] = count($is);
			$arr[$k]["replay_content"] = $is?$is:array();
			
		}
		return $arr;
	}
	//回复帖子的个人信息
	public function tieuser($user_id,$fenlei_id){
		$user = M("user")->field("t_user.pic,t_user.nickname,t_user.sex")->where("t_user.id = '$user_id'")->find();
		$levels = M("point")->where("uid = '$user_id' && fenlei_id = '$fenlei_id' && state = 1")->find();
		$level = $levels["level"];
		$point = $levels["point"];
		$user["level"] = $level?$level:"-1";
		$user["point"] = $point;
		return $user;
	}
	//返回昵称
	public function getnickname($replay){
		$user = M("comment")->field("t_user.nickname")->join("t_user ON t_user.id = t_comment.uid")->where("t_comment.id = '$replay' && t_comment.is_delete = 2")->find();
		return $user["nickname"];
	}
	//返回时间差
	public function gettimepoor($ctime){
		$cbtime = time() - $ctime;
		if(3600 > $cbtime){
			return round(($cbtime/60),0)."分钟前";
		}
		elseif(24*3600 > $cbtime){
			return round(($cbtime/3600),0)."小时前";
		}
		elseif(7*24*3600 > $cbtime){
			return round(($cbtime/(3600*24)),0)."天前";
		}
		elseif(30*24*3600 > $cbtime){
			return round(($cbtime/(3600*24*7)),0)."周前";
		}
		elseif(12*30*24*3600 > $cbtime){
			return round(($cbtime/(3600*24*30)),0)."月前";
		}
		elseif(12*30*24*3600 < $cbtime){
			return round(($cbtime/(3600*24*30*12)),0)."年前";
		}
	}
	//判断是否可以发送验证码
	public function issendcode($udid){
		$is60 = S($udid);
		if($is60){
			$return["code"] = "2";
			$return["message"] = "60秒之后再次获取";
			return $return;
		}
		$info = M("udid")->where("udid_name = '$udid'")->find();
		if($info){
			$ytime = $info["time"];
			$xtime = date("Ymd",time());
			if($xtime > $ytime){
				$return["code"] = "1"; 
				$return["message"] = "可以发送";
				return $return;
			}
			elseif($xtime == $ytime){
				$number = $info["number"];
				if($number >=5){
					$return["code"] = "2";
					$return["message"] = "今日发送短信超过5次";
					return $return;
				}else{
					$return["code"] = "1"; 
					$return["message"] = "可以发送";
					return $return;
				}
			}
		}else{
			$return["code"] = "1";         //1可以发送；2不可以发送
			$return["message"] = "可以发送";
			return $return;
		}
	}
	//改变udid状态
	public function gaiudidstate($udid){
		S($udid,"1",60);
		$info = M("udid")->where("udid_name = '$udid'")->find();
		if($info){
			$ytime = $info["time"];
			$xtime = date("Ymd",time());
			if($xtime > $ytime){
				$data["time"] = $xtime;
				$data["number"] = "1";
				$re = M("udid")->where("udid_name = '$udid'")->save($data);
				$return["code"] = "1";
				$return["message"] = "可以发送";
				return $return;
			}
			elseif($xtime == $ytime){
				$number = $info["number"];
				if($number >=5){
					$return["code"] = "2";
					$return["message"] = "今日发送短信超过5次";
					return $return;
				}else{
					$re = M("udid")->where("udid_name = '$udid'")->setInc('number',1); 
					$return["code"] = "1";
					$return["message"] = "可以发送";
					return $return;
				}
			}
		}else{
			$data["udid_name"] = $udid;
			$data["number"] = "1";
			$data["time"] = date("Ymd",time());
			$re = M("udid")->add($data);
			$return["code"] = "1";         //1可以发送；2不可以发送
			$return["message"] = "可以发送";
			return $return;
		}
	}
	//问老师上传图片
	public function uploadpask(){
    	$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =    3145728 ;// 设置附件上传大小
		$upload->exts      =    array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath  =    './Public/Uploads/problem/pic/'; // 设置附件上传根目录
		$upload->subName  =     array('date','Ymd');
		$upload->autoSub  =     true;
		// 上传单个文件
		$info   =   $upload->uploadOne($_FILES['image']);
		if(!$info) {
			return $upload->getError();
		}else{
			$filePath = $info['savepath'].$info['savename'];
			$thumbpic = $this->thumbpic($upload->rootPath,$filePath);
			return "http://120.27.98.52/teacher/Public/Uploads/problem/pic/".$thumbpic;
		};
	}
	//上传问题图片
	public function wenuploadpic($type){
    	$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =    223145728 ;// 设置附件上传大小
		$upload->exts      =    array('jpg', 'gif', 'png', 'jpeg', 'acf', 'mp3', 'mp4');// 设置附件上传类型
		
		if($type==2){
			$upload->rootPath  =    './Public/Uploads/problem/video/'; // 设置附件上传根目录
		}elseif($type==3){
			$upload->rootPath  =    './Public/Uploads/problem/pic/'; // 设置附件上传根目录
		}else{
			$upload->rootPath  =    './Public/Uploads/TeaPic/'; // 设置附件上传根目录
		}
		
		$upload->subName  =     array('date','Ymd');
		$upload->autoSub  =     true;
		// 上传单个文件
		$info   =   $upload->uploadOne($_FILES['image']);
		if(!$info) {
			return $upload->getError();
		}else{
			$filePath = $info['savepath'].$info['savename'];
			//$thumbpic = $this->thumbpic($upload->rootPath,$filePath);
			/*return array(
				'smallpic'=>"http://120.27.98.52/teacher/Public/Uploads/TeaPic/".$thumbpic,
				'pic'=>"http://120.27.98.52/teacher/".$upload->rootPath.$filePath);*/
			return "http://120.27.98.52/teacher/".$upload->rootPath.$filePath;
		};
	}
	//上传头像
	public function uploadpic(){
    	$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =    3145728 ;// 设置附件上传大小
		$upload->exts      =    array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath  =    './Public/Uploads/UserPic/'; // 设置附件上传根目录
		$upload->subName  =     array('date','Ymd');
		$upload->autoSub  =     true;
		// 上传单个文件
		$info   =   $upload->uploadOne($_FILES['image']);
		//echo "<pre>";print_r($info);print_r($_FILES);
		if(!$info) {
			return $upload->getError();
		}else{
			$filePath = $info['savepath'].$info['savename'];
			$thumbpic = $this->thumbpic($upload->rootPath,$filePath);
			return "http://120.27.98.52/helpme/Public/Uploads/UserPic/".$thumbpic;
		};
	}
	//文章上传图片
	public function uploadtie(){
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =    3145728 ;// 设置附件上传大小
		$upload->exts      =    array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath  =    './Public/Uploads/Article/'; // 设置附件上传根目录
		$upload->subName  =     array('date','Ymd');
		$upload->autoSub  =     true;
		// 上传单个文件
		$info   =   $upload->uploadOne($_FILES['image']);
		if(!$info) {
			return $upload->getError();
		}else{
			$filePath = $info['savepath'].$info['savename'];
			$thumbpic = $this->thumbpic($upload->rootPath,$filePath);
			return "http://120.27.98.52/helpme/Public/Uploads/Article/".$thumbpic;
		};
	}
	/*
	**保存第三方头像
	** @ ./Public/Uploads/UserPic/
	*/
	public function savewebpic($url){
		$rootPath = "./Public/Uploads/wxpic/";
		$name = $this->makeUserKey(16,rand(1,10000)).".png";
		$img = $this->GrabImage($url,$rootPath.$name);
		$picurl = $this->thumbpic($rootPath,$name);
		return "http://120.27.98.52/teacher/Public/Uploads/wxpic/".$picurl;
	}
	/*
	** 压缩图片
	** @rootPath 图片路径  例如： ./Public/Uploads/UserPic/
	** @name     图片名称  例如： sxudpuvlzrzozbjd3646.png
	*/
	private function thumbpic($rootPath,$name){
		$datas = explode ('.', $name);
		$image = new \Think\Image();
		$image->open($rootPath.$name);
		$image->thumb(250, 150)->save($rootPath.$datas[0].'_thumb.jpg');
		return $datas[0].'_thumb.jpg';
	}
	// 变量说明:
	// $url 是远程图片的完整URL地址，不能为空。
	// $filename 是可选变量: 如果为空，本地文件名将基于时间和日期// 自动生成.
	public function GrabImage($url,$filename='') {
		if($url==''):return false;endif;
		if($filename=='') {
			$ext=strrchr($url,'.');
			if($ext!='.gif' && $ext!='.jpg' && $ext!='.png'):return false;endif;$filename=date('dMYHis').$ext;
		}
		ob_start();
		readfile($url);
		$img = ob_get_contents();
		ob_end_clean();
		$size = strlen($img);
		$fp2=@fopen($filename, 'a+');
		fwrite($fp2,$img);
		fclose($fp2);
		return $filename;
	}
	//生成用户邀请码
	static function makeUserKey($number=6,$user_id){
		$user_key='';
		for ($i=1; $i<=$number;$i++) {
			$user_key.=chr(rand(97, 122));
		}
		$user_key.=$user_id;
		return $user_key;
	}
	 /**
     * 模板接口发短信
     * apikey 为云片分配的apikey
     * tpl_id 为模板id
     * tpl_value 为模板值
     * mobile 为接受短信的手机号
     */
    public function tpl_send_sms($apikey, $tpl_id, $tpl_value, $mobile){
    	$url="http://yunpian.com/v1/sms/tpl_send.json";
    	$encoded_tpl_value = urlencode("$tpl_value");
    	$post_string="apikey=$apikey&tpl_id=$tpl_id&tpl_value=$encoded_tpl_value&mobile=$mobile";
    	return $this->sock_post($url, $post_string);
    }
    
    /**
     * url 为服务的url地址
     * query 为请求串
     */
    private function sock_post($url,$query){
    	$data = "";
    	$info=parse_url($url);
    	$fp=fsockopen($info["host"],80,$errno,$errstr,30);
    	if(!$fp){
    		return $data;
    	}
    	$head="POST ".$info['path']." HTTP/1.0\r\n";
    	$head.="Host: ".$info['host']."\r\n";
    	$head.="Referer: http://".$info['host'].$info['path']."\r\n";
    	$head.="Content-type: application/x-www-form-urlencoded\r\n";
    	$head.="Content-Length: ".strlen(trim($query))."\r\n";
    	$head.="\r\n";
    	$head.=trim($query);
    	$write=fputs($fp,$head);
    	$header = "";
    	while ($str = trim(fgets($fp,4096))) {
    		$header.=$str;
    	}
    	while (!feof($fp)) {
    		$data .= fgets($fp,4096);
    	}
    	return $data;
    }
}