<?php
namespace Admin\Controller;
use Think\Controller;
class OrganizeconstructController extends Controller{
	//用户管理
	public function usermanager(){

		$m = M("user");
		if($_SESSION[id]==1){
            $count      = $m->count();
            $Page       = new \Think\Page($count,10);
            $show       = $Page->show();// 分页显示输出
            $list = $m->order('id desc')->limit($Page->firstRow.','.$Page->listRows)
                ->select();
            $js = M("organization")->field("name,id")->select();
        }else{
            $c = $m->order('id desc')
                ->where("jl_id='$_SESSION[id]'")
                ->select();
            $count      = count($c);
            $Page       = new \Think\Page($count,10);
            $show       = $Page->show();// 分页显示输出
            $list = $m->order('id desc')->limit($Page->firstRow.','.$Page->listRows)
                ->where("jl_id='$_SESSION[id]'")
                ->select();
            $js = M("organization")->where("jl_id='$_SESSION[id]'")->field("name,id")->select();

        }

		$this->assign("list",$list);
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);
		$this->js = $js;
		$this->display();
	}
	//取出管理员下面的用户
    public function getuser(){
	    $id=I('get.id');
        $js = M("organization")->field("name,id")->select();
        $m = M("user");
        $count      = $m->count();
        $Page       = new \Think\Page($count,10);
        $show       = $Page->show();// 分页显示输出
        $list = $m->order('id desc')
            ->where("jl_id='$id'")
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();
        $this->assign("list",$list);
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);
        $this->js = $js;
      // var_dump($list);
        $this->display('usermanager');
    }
	//新增用户
	public function adduser(){
		$js = M("organization")
				->where("jl_id='$_SESSION[id]'")
				->field("name,id")->select();
		$this->js = $js;
		$this->display();
	}
	public function adduserOk(){
		if(IS_POST){
            $data['jl_id']=$_SESSION['id'];
            $kouling=D('jingli')->field('kouling')->where("id='$_SESSION[id]'")->find();
			$data['student_number'] = ($kouling['kouling']).I('post.student_number');
			$data['nickname'] = I('post.nickname');
			$data['workingPlace'] = I("post.workingPlace");
			$data['ctime'] = time();
			$data['groups'] = I('post.groups');
			$data['password'] = md5(123456);
            $data['companytype']='';
            $data['organization']='';
            $data['moodsocre']='';
            $data['moodremark']='';
            $data['moodtime']='';
//            $data['jl_id']=$_SESSION['id'];
			$bool = D('user')->add($data);

			if($bool){
				$this->success("添加用户成功!",U("Organizeconstruct/usermanager"),3);
			}else{
				$this->error("添加失败!");
			}
		}
	}
	//编辑用户
	public function editUser(){
		$uid = I('get.uid');
		$data = M("user")->where("id = '$uid'")->select();
		$js = M("organization")->field("name,id")->where("jl_id='$_SESSION[id]'")->select();
		$leida = M("radardatas")->where("user_id = '$uid'")->select();
		foreach ($leida as $key => $value) {
			$observe += $value['observe'];
			$rember += $value['rember'];
			$emotion += $value['emotion'];
			$thinking += $value['thinking'];
			$willpower += $value['willpower'];
		}
		//雷达的五个数据
		$data[0]['observe'] = $observe;
		$data[0]['rember'] = $rember;
		$data[0]['emotion'] = $emotion;
		$data[0]['willpower'] = $willpower;
		$data[0]['thinking'] = $thinking;
		//print_r($data);exit();
		$this->js = $js;
		$this->data = $data;
		$this->display();
	}
	public function editUserOk(){
		$uid = I('get.uid');
		$data['nickname'] = I('post.nickname');
		$data['realname'] = I('post.realname');
		$data['groups'] = I('post.groups');
		$data['companytype'] = I('post.companytype');
		$sex = I('post.sex');
		if ($sex == "男") {
			$data['sex'] = 1;
		}elseif ($sex == "女") {
			$data['sex'] = 2;
		}
		else{
			$data['sex'] =0 ;
		}
		$data['birthday'] = I('post.birthday');
		$data['position'] = I('post.position');
		$data['medicalHistory'] = I('post.medicalHistory');
		$data['workingPlace'] = I('post.workingPlace');
		$data['mobile'] = I('post.mobile');
        $data['position'] = I('post.position');
//        var_dump($data['position']);die();
		$bool = M("user")->where("id = $uid")->save($data);
		if($bool){
			$this->success("修改成功!",U("Organizeconstruct/usermanager"),3);		
		}else{
				$this->error("修改失败!");
		}
	}
	public function stopUser(){
		$uid = I('get.uid');
		$state = M("user")->where("id = $uid")->getField("locked");
		if($state == 1){
		$data['locked'] = 2;
		$bool = M("user")->where("id = $uid")->save($data);
		if($bool){
			$this->success("停用成功!",U("Organizeconstruct/usermanager"),3);
		}}else{
		$data['locked'] = 1;
		$bool = M("user")->where("id = $uid")->save($data);
		if($bool){
			$this->success("启用成功",U("Organizeconstruct/usermanager"),3);
			}
		}
	}
	public function deleteUser(){
		$uid = I('get.uid');
		$bool = M("user")->where("id = $uid")->delete();
		$re = M("record")->where("user_id = '$uid'")->delete();
		if($bool){
			$this->success("用户成功被删除!");
		}
	}
	public function deletesUser(){
		$uid = I('post.test');
		if(is_array($uid)){   
		    $where = 'id in('.implode(',',$uid).')';  
		    $wheres = 'user_id in('.implode(',',$uid).')';  
		}else{  
		   $where = 'id='.$uid; 
		   $wheres = 'user_id='.$uid; 
		} 
		$bool=M("user")->where($where)->delete();  
		$re = M("record")->where($wheres)->delete();
		if($bool ){
			$this->success("用户成功被删除!");
		}else{
			$this->error("删除失败!");
		}
	}

	//用户搜索
	public function usersearch(){
		// var_dump($_POST);die();
		$m = M("user");
		$name = I('post.uname','','trim');//学号
		$sel = I('post.sel','','trim');//用户组
		$time = I('post.time','','trim');//名称
		$position = I('post.position','','trim');
		if($_SESSION==1){
            $where = array(
                'student_number' => $name,
                // 'workingPlace' => $time,
                'groups' => $sel,
                'nickname' => $time,
                // 'position' => $position
            );
            $js = M("organization")->field("name,id")->select();
        }else{
            $where = array(
                'student_number' => $name,
                // 'workingPlace' => $time,
                'groups' => $sel,
                'nickname' => $time,
                'jl_id'=>$_SESSION['id'],
                // 'position' => $position
            );
            $js = M("organization")->where("jl_id='$_SESSION[id]'")->field("name,id")->select();

        }

		$lastwhere = array_filter($where);
		if (empty($lastwhere)) {
			$list = $m->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
			$count      = count($list);
		}else{
			$list = $m->where($lastwhere)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
			$count      = count($list);
		}
		/*print_r($list);
		exit("ddd");
		echo $name."<br>";
		echo $sel."<br>";
		echo $time."<br>";
		echo $position."<br>";exit("hello");*/
		//$str = rawurldecode(I('get.str','','trim'));		
		//$count      = $m->count();
   		$Page       = new \Think\Page($count,10);
   		$show       = $Page->show();// 分页显示输出
   		/*if (($name && !$sel && !$time)) {*/
   			
/*   		}else if ((!$name && $sel && !$time)){

        	$list = $m->where(" groups = '$sel' ")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
   		}else if ((!$name && $sel && !$time)){

        	$list = $m->where(" workingPlace like '%$time%'  ")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
   		}else{

        	$list = $m->where("nickname like '%$name%' && workingPlace like '%$time%' && groups = '$sel' ")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
   		}*/

		$this->assign("js",$js);
		$this->assign("list",$list);
		$this->assign("count",$count);
        $this->assign('page',$show);// 赋值分页输出
		$this->display('usermanager');
	}
	//角色管理
	public function jsmanager(){	
		$m = M("Js");
		$aa = $m->where("jl_id=$_SESSION[id]")->select();
        $count = count($aa);
        $Page       = new \Think\Page($count,10);
        $show       = $Page->show();// 分页显示输出
        $data = $m
			->field("id,fid,name,ctime,description")
			->order('id asc')
            ->where("jl_id=$_SESSION[id]")
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();
                    for($i = 0; $i < count($data); $i++){
                    $where['id'] = array("in",$data[$i]['fid']);
                    //print_r($where);
                    $code = M('fenlei')->field("name")->where($where)->select();
                    //echo M("fenlei")->getlastsql();
                    $acode = array();
                    for($j = 0;$j < count($code);$j++){
                        $acode[$j] = $code[$j]['name'];
                    }
                    $acode = implode(",",$acode);
                    $data[$i]['fid'] = $acode;
                }
		//print_r($data);

		$this->assign("count",$count);
		$this->assign("list",$data);
        $this->assign('page',$show);// 赋值分页输出
		$this->display();	
	}
	//添加角色
	public function jsAdd(){
		$fenlei = M("fenlei")->select(); 
		$big = array();
		foreach($fenlei as $v){
			if($v['fid']==0)
				$big[] = $v;
		}
		foreach($big as $k => $v){
			foreach($fenlei as $v2){
				if($v['id']==$v2['fid'])
					$big[$k]['zi'][] = $v2;
			}
		}
		foreach($big as $k=>$v){
			foreach($big[$k]['zi'] as $k3=>$v3){
				foreach($fenlei as $v4){
					if($v3['id']==$v4['fid'])
						$big[$k]['zi'][$k3]['zi'][] =$v4;
				}
			}
		}
		$this->assign("fenlei",$big);
		$this->display();
	}
	//添加角色
	public function jsAdds(){
		$fenlei = M("fenlei")->select(); 
		$big = array();
		foreach($fenlei as $v){
			if($v['fid']==0)
				$big[] = $v;
		}
		foreach($big as $k => $v){
			foreach($fenlei as $v2){
				if($v['id']==$v2['fid'])
					$big[$k]['zi'][] = $v2;
			}
		}
		foreach($big as $k=>$v){
			foreach($big[$k]['zi'] as $k3=>$v3){
				foreach($fenlei as $v4){
					if($v3['id']==$v4['fid'])
						$big[$k]['zi'][$k3]['zi'][] =$v4;
				}
			}
		}
		$this->assign("fenlei",$big);
		$this->display();
	}
	//添加角色成功
	public function jsAddOk(){
		$data['name'] = I('post.name','','trim');
		//$data['jscode'] = I('post.namecode','','trim');
		$data['description'] = I('post.description','','trim');
		$data['jcode'] = I('post.jcode','','trim');
		$data['fid'] = implode(",",$_POST['fid']);
		//$where['name'] = array("in",$data['fid']);
		$data['ctime'] = date('Y-m-d H:i:s');
		/*$aid = M('fenlei')->field("id")->where($where)->select();
		$id = array();
		for($i = 0;$i < count($aid);$i++){
			$id[$i] = $aid[$i]['id'];
		}
		$id = implode(",",$id);
		$data['fid'] = $id;*/
		//print_r($data);exit();
		$bool = M('Js')->add($data);
		if($bool != NULL){
			$this->success("添加角色成功!",U("Organizeconstruct/jsmanager"),3);
		}else{
			$this->error("添加失败!");
		}
	}
	//角色搜索
	public function jsSearch(){
		$m = M("Js");
		$str = rawurldecode(I('get.str','','trim'));		
		$count      = $m->count();
       	$Page       = new \Think\Page($count,10);
       	$show       = $Page->show();// 分页显示输出
		$show       = $Page->show();// 分页显示输出
		$list = $m
			->field("id,fid,name,ctime,description")
			->where("name like '%$str%'")
			->limit($Page->firstRow.','.$Page->listRows)
			->select();
			for($i = 0; $i < count($list); $i++){
			$where['id'] = array("in",$list[$i]['fid']); 
			//print_r($where);
			$code = M('fenlei')->field("name")->where($where)->select();	
			//echo M("fenlei")->getlastsql();
			$acode = array();
			for($j = 0;$j < count($code);$j++){
				$acode[$j] = $code[$j]['name'];
			}
			$acode = implode(",",$acode);
			$list[$i]['fid'] = $acode;
		}
		$this->assign("list",$list);
        $this->assign('page',$show);// 赋值分页输出
		$this->display('jsmanager');
	}
	//修改角色
	public function editJs(){
		$uid = I('get.uid');	
		$data = M("Js")->field("id,fid,name,ctime,description")
			->where("id = $uid")->select();

		$fenlei = M("fenlei")->select(); 
		$big = array();
		//取出一级权限
		foreach($fenlei as $v){
			if($v['fid']==0)
				$big[] = $v;
		}
		//取出二级权限
		foreach($big as $k => $v){
			foreach($fenlei as $v2){
				if($v['id']==$v2['fid'])
					$big[$k]['zi'][] = $v2;
			}
		}
		//取出三级权限
		foreach($big as $k=>$v){
			foreach($big[$k]['zi'] as $k3=>$v3){
				foreach($fenlei as $v4){
					if($v3['id']==$v4['fid'])
						$big[$k]['zi'][$k3]['zi'][] =$v4;
				}
			}
		}


		for($i = 0; $i < count($data); $i++){
			$where['id'] = array("in",$data[$i]['fid']); 
			//print_r($where);
			$code = M('fenlei')->field("id,name")->where($where)->select();

			//echo M("fenlei")->getlastsql();
			$acode = array();
			for($j = 0;$j < count($code);$j++){
				$acode[$j] = $code[$j]['name'];
				$xuanzhong[]=$code[$j]['id'];
			}
			$acode = implode(",",$acode);
			$data[$i]['fid'] = $acode;
		}
//var_dump($xuanzhong);
//        dump($bigg);
        $this->assign('xuanzhong',$xuanzhong);//用户角色包含的所有权限
		$this->assign("fenlei",$big);
		$this->assign("data",$data);
		$this->display();
	}
	//修改角色成功
	public function editJsOk(){
		$uid = I('get.uid','','trim');
		$data['name'] = I('post.name','','trim');
		$fids = I('post.fids','','trim');
		$fid = implode(",",$_POST['fid']);
		$data['description'] = I('post.description','','trim');

		/*$ctime = I('post.ctime','','trim');
		$data['ctime'] = strtotime($ctime);
		$data['ctime'] = $ctime;*/


		if (isset($fid)) {
			$data['fid'] = $fid;
		}else{
			// echo $fids;
			$arr = explode(',',$fids);
			$where['name'] = array("in",$arr); 
			$code = M('fenlei')->field("id")->where($where)->select();
			//print_r($code);exit("code");
			foreach ($code as $key => $value) {
				$fidd .= ",".$value['id'];
			}
			$lastfid = ltrim($fidd,',');
			$data['fid'] = $lastfid;
		}
		$bool = M('Js')->where("id = $uid")->save($data);
		if($bool){
			$this->success("修改成功",U("Organizeconstruct/jsmanager"),3);
		}else{
			$this->error("修改失败!");
		}
	}
	//删除角色
	public function deleteJs(){
		$uid = I('get.uid','','trim');
		$bool = M('Js')->where("id = $uid")->delete();
		if($bool){
			$this->success("删除成功!",U("Organizeconstruct/jsmanager"),3);
		}else{
			$this->error("删除失败!");
		}
	}
	//权限管理
	public function authormanager(){
		$m = M("fenlei");
        $count      = $m->count();
        $Page       = new \Think\Page($count,10);
        $show       = $Page->show();// 分页显示输出
        $list = $m->field("id,name,acode,description")
			->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign("list",$list);
        $this->assign('page',$show);// 赋值分页输出
		$this->display();
	}
	//修改权限
	public function editAuth(){
		$aid = I('param.aid','','trim');
		$data = M('fenlei')->where("id = $aid")->select();
		$this->data = $data;
		$this->display();
	}
	//修改权限成功
	public function editAuthOk(){
		$aid = I('get.aid','','trim');
		$data['name'] = I('post.name','','trim');
		$data['acode'] = I('post.acode','','trim');
		$data['description'] = I('post.description','','trim');
		$bool = M('fenlei')->where("id = $aid")->save($data);
		if($data != NULL){
			$this->success("修改成功!",U("Organizeconstruct/authormanager"),'trim');
		}else{
			$this->error("修改失败!");
		}		
	}
	//增加权限
	public function addAuth(){
		$this->display();
	}
	//增加权限成功
	public function addAuthOk(){
		$data['name'] = I('post.name','','trim');
		$data['acode'] = I('post.namecode','','trim');
		$data['description'] = I('post.description','','trim');
		$bool = M('fenlei')->add($data);
		if($bool){
			$this->success("添加权限成功!",U("Organizeconstruct/authormanager"),3);
		}else{
			$this->error("添加权限失败!");
		}
	}
	//删除权限
	public function deleteAuth(){
		$aid = I('get.aid','','trim');
		$bool = M('fenlei')->where("id = $aid")->delete();
		if($bool){
			$this->success("删除成功!",U("Organizeconstruct/authormanager"),3);
		}else{
			$this->error("删除失败!");
		}
	}
	//权限搜索
	public function authSearch(){
		$str = I('get.str','','trim');
		$m = M("fenlei");
        $count      = $m->count();
		$Page       = new \Think\Page($count,10);
		$show       = $Page->show();// 分页显示输出
	 	$list = $m->field("id,name,acode,description")->where("name like '%$str%'")
			->order('id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign("list",$list);
       	$this->assign('page',$show);// 赋值分页输出
		$this->display("authormanager");
	}
	//组织列表
	public function orgmanager(){
		$m = M("organization");
		if($_SESSION['id']==1){
            $count      = $m->count();
            $Page       = new \Think\Page($count,10);
            $show       = $Page->show();// 分页显示输出
            $list = $m->order('id desc')->limit($Page->firstRow.','.$Page->listRows)
                ->select();

        }else{
            $count      = $m->count();
            $Page       = new \Think\Page($count,10);
            $show       = $Page->show();// 分页显示输出
            $list = $m->order('id desc')->limit($Page->firstRow.','.$Page->listRows)
                ->where("jl_id='$_SESSION[id]'")
                ->select();
        }

		$this->assign("count",$count);
		$this->assign("list",$list);
        $this->assign('page',$show);// 赋值分页输出
		$this->display();
	}

	//增加组织
	public function addorg(){
		$js = M("js")->where("jl_id='$_SESSION[id]'")->field("name,id")->select();
		$this->js = $js;
		$this->display();
	}

	public function addorgOk(){
		if(IS_POST){
			$data['name'] = I('post.name');
			$data['js_name'] = I("post.identity");
			$data['jl_id'] = $_SESSION['id'];
			$bool = M('organization')->add($data);
			if($bool){
				$this->success("添加组织成功!",U("Organizeconstruct/orgmanager"),3);
			}else{
				$this->error("添加失败!");
			}
		}
	}


	//删除组织
	public function deleteorg(){
		$id = I('get.id','','trim');
		$name = M("organization")->where("id = '$id'")->getfield("name");
		$ids = M("user")->field("id")->where("groups = '$name'")->select();
		foreach ($ids as $key => $value) {
			$user_id = $value['id'];
			M('user')->where("id  ='$user_id'")->delete();
		}
		$bool = M('organization')->where("id = $id")->delete();
		if($bool){
			$this->success("删除成功!",U("Organizeconstruct/orgmanager"),3);
		}else{
			$this->error("删除失败!");
		}
	}
	//查看组织用户
	public function viewuser(){
		$id = I('get.id','','trim');
		$organization = M("organization")->where("id = '$id'")->getField("name");
		//echo $js;exit("hello");
		
		$user = M("user")->where("groups = '$organization'")->select();
        $count      = count($user);
       	$Page       = new \Think\Page($count,10);
       	$show       = $Page->show();// 分页显示输出

		$user = M("user")->where("groups = '$organization'")->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign("count",$count);
		$this->assign("list",$user);
        $this->assign('page',$show);// 赋值分页输出
		$this->display();
	}


	//组织搜索
	public function orgSearch(){
		$m = M("organization");
		$str = rawurldecode(I('get.str','','trim'));		

        if($_SESSION['id'] ==1){
            $count      = $m->count();
            $Page       = new \Think\Page($count,10);
            $show       = $Page->show();// 分页显示输出
            $show       = $Page->show();// 分页显示输出
            $list = $m
            ->field("id,name,ctime,js_name")
                ->where("name like '%$str%' ")
                ->limit($Page->firstRow.','.$Page->listRows)
                ->select();
        }else{
            $count      = $m->count();
            $Page       = new \Think\Page($count,10);
            $show       = $Page->show();// 分页显示输出
            $show       = $Page->show();// 分页显示输出
            $list = $m
                ->field("id,name,ctime,js_name")
                ->where("name like '%$str%' and jl_id='$_SESSION[id]'")
                ->limit($Page->firstRow.','.$Page->listRows)
                ->select();
            }

			/*for($i = 0; $i < count($list); $i++){
			$where['id'] = array("in",$list[$i]['fid']); 
			//print_r($where);
			$code = M('fenlei')->field("name")->where($where)->select();	
			//echo M("fenlei")->getlastsql();
			$acode = array();
			for($j = 0;$j < count($code);$j++){
				$acode[$j] = $code[$j]['name'];
			}
			$acode = implode(",",$acode);
			$list[$i]['fid'] = $acode;
		}*/
		$this->assign("list",$list);
        $this->assign('page',$show);// 赋值分页输出
		$this->display('orgmanager');
	}


	//编辑组织
	public function editorg(){
		$oid = I('get.id');
		$data = M("organization")->field("name,id,js_name")->where("id = '$oid'")->select();
		$js = M("js")->where("jl_id='$_SESSION[id]'")->field("name,id")->select();
		$this->js = $js;
		$this->data = $data;
		$this->display();
	}
	//修改组织成功
	public function editorgOk(){
		$uid = I('get.id');
		$data = I("param.identity","","trim");
		//print_r($data);exit();
		$bool = M("organization")->where("id = $uid")->setfield("js_name",$data);
		if($bool){
			$this->success("修改成功!",U("Organizeconstruct/orgmanager"),3);		
		}else{
				$this->error("修改失败!");
		}
	}

	public function aaa(){
		$uid = I('post.test');
		if(is_array($uid)){   
		    $where = 'id in('.implode(',',$uid).')';  
		}else{  
		   $where = 'id='.$uid; 
		} 
		print_r($uid);exit();
		//header("Content-type:application/vnd.ms-excel");  
   		//header("Content-Disposition:attachment;filename=record.xls");
   		
   		//echo $id;exit("id");
   		//$data = M('Record')->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.*")->where("h_record.id = '$id'")->find();
   		//var_dump($data);exit();
   		/*if($data)
   		{
   			echo "";
   		}*/
	}
//个人记录列表
	public function record(){
		$uid = I('get.id');
		 $m = M("Record");
		 $lista = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->where("user_id = '$uid'")->select();
           	$count = count($lista);
           	$Page       = new \Think\Page($count,10);
           	$show       = $Page->show();// 分页显示输出
            	//$count      = $m->count();
           	 //$list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,timetype as rkind")->select();
           	 $list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                 ->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")
                 ->where("user_id = '$uid'")
                 ->order('h_record.id desc')
                 ->limit($Page->firstRow.','.$Page->listRows)
                 ->select();
			$sel = M('Record')->distinct(true)->field('timetype')->select();
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

           	if($_SESSION==1){
                $m=D('organization');
                $group=$m->select();
            }else{
                $m=D('organization');
                $group=$m->where("jl_id='$_SESSION[id]'")->select();
            }


        // /print_r($list);exit("ccc");
           		$this->assign("group",$group);
			$this->assign("sel",$sel);
			$this->assign("list",$list);
			$this->assign("count",$count);
			$this->assign('page',$show);// 赋值分页输出
			$this->display();
	}
    public function recordSearch(){
        $name = I('get.uname','','trim');//姓名
        $sel = I('get.sel','','trim');//类型
//		$time = I('get.time','','trim');
        $group = I('get.group','','trim');//用户组
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
            if($_SESSION['id']==1){
                $n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                    ->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                    ->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')
                    ->where("h_user.nickname like '$name' ")
                    ->limit($Page->firstRow.','.$Page->listRows)->select();
                $count      = count($n);
                $Page       = new \Think\Page($count,10);
                $show       = $Page->show();// 分页显示输出
                $list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                    ->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                    ->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")
                    ->order('h_record.id asc')->where("h_user.nickname like '$name' ")
                    ->limit($Page->firstRow.','.$Page->listRows)->select();
            }else{
                $n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                    ->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                    ->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')
                    ->where("h_user.nickname like '$name' and h_user.jl_id='$_SESSION[id]'")
                    ->limit($Page->firstRow.','.$Page->listRows)->select();
                $count      = count($n);
                $Page       = new \Think\Page($count,10);
                $show       = $Page->show();// 分页显示输出
                $list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                    ->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                    ->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")
                    ->order('h_record.id asc')->where("h_user.nickname like '$name'and h_user.jl_id='$_SESSION[id]' ")
                    ->limit($Page->firstRow.','.$Page->listRows)->select();
            }

        }else if ($name == null && $sel  != null && $time == null) {
            //echo "有类型";
            if($_SESSION['id']==1){
                $n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                    ->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                    ->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")
                    ->order('h_record.id asc')->where(" h_record.timetype = '$sel' ")
                    ->limit($Page->firstRow.','.$Page->listRows)->select();
                $count      = count($n);
                $Page       = new \Think\Page($count,10);
                $show       = $Page->show();// 分页显示输出
                $list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                    ->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                    ->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")
                    ->order('h_record.id asc')
                    ->where(" h_record.timetype = '$sel' ")
                    ->limit($Page->firstRow.','.$Page->listRows)->select();

            }else{
                $n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                    ->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                    ->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")
                    ->order('h_record.id asc')->where(" h_record.timetype = '$sel' and  h_user.jl_id='$_SESSION[id]' ")
                    ->limit($Page->firstRow.','.$Page->listRows)->select();
                $count      = count($n);
                $Page       = new \Think\Page($count,10);
                $show       = $Page->show();// 分页显示输出
                $list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                    ->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                    ->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")
                    ->order('h_record.id asc')
                    ->where(" h_record.timetype = '$sel' and  h_user.jl_id='$_SESSION[id]'")
                    ->limit($Page->firstRow.','.$Page->listRows)->select();
                echo M()->getLastSql();
            }

        }else if ($name == null && $sel == null && $time != null) {
            //echo "有时间";
            $n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where(" h_record.rtime like '%$time%' ")->limit($Page->firstRow.','.$Page->listRows)->select();
            $count      = count($n);
            $Page       = new \Think\Page($count,10);
            $show       = $Page->show();// 分页显示输出
            $list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                ->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                ->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where(" h_record.rtime like '%$time%' ")->limit($Page->firstRow.','.$Page->listRows)->select();
        }else if ($name == null && $sel == null && $time == null && $group != null ) {
            // echo "用户组";die();
            if($_SESSION['id']==1){
                $user=D('user');
                $c = $user->alias('a')
                    ->where("groups='$group' ")
                    ->join('LEFT JOIN h_record b  on b.user_id= a.id')
                    ->select();
//				var_dump($c);
                $count      = count($c);
                $Page       = new \Think\Page($count,10);
                $show       = $Page->show();// 分页显示输出
                $list= $user->alias('a')
                    ->field("a.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")
                    ->join('LEFT JOIN h_record   on h_record.user_id=a.id')
                    ->where("a.groups='$group' ")
                    ->order('h_record.id asc')
                    ->limit($Page->firstRow.','.$Page->listRows)
                    ->select();
            }else{
                $user=D('user');
                $c = $user->alias('a')
                    ->where("groups='$group' and jl_id='$_SESSION[id]' ")
                    ->join('LEFT JOIN h_record b  on b.user_id= a.id')
                    ->select();
                $count      = count($c);
                $Page       = new \Think\Page($count,10);
                $show       = $Page->show();// 分页显示输出
                $list= $user->alias('a')
                    ->field("a.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")
                    ->join('LEFT JOIN h_record   on h_record.user_id=a.id')
                    ->where("a.groups='$group' and jl_id='$_SESSION[id]'")
                    ->order('h_record.id asc')
                    ->limit($Page->firstRow.','.$Page->listRows)
                    ->select();
            }
        }else if ($name != null && $sel  != null && $time != null) {
            $n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                ->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                ->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")
                ->order('h_record.id asc')->where("h_user.nickname like '$name' && h_record.rtime like '%$time%' && timetype = '$sel'")
                ->limit($Page->firstRow.','.$Page->listRows)->select();
            $count      = count($n);
            $Page       = new \Think\Page($count,10);
            $show       = $Page->show();// 分页显示输出
            $list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where("h_user.nickname like '$name' && h_record.rtime like '%$time%' && timetype = '$sel'")->limit($Page->firstRow.','.$Page->listRows)->select();

        }else if ($name != null && $sel  != null && $time == null) {
            //echo "名字类型";
            $n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                ->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                ->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")
                ->order('h_record.id asc')->where("h_user.nickname like '$name'  && timetype = '$sel'")
                ->limit($Page->firstRow.','.$Page->listRows)->select();
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
            if($_SESSION['id']==1){
                $n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                    ->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                    ->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")
                    ->order('h_record.id asc')
                    ->limit($Page->firstRow.','.$Page->listRows)->select();
                $count      = count($n);
                $Page       = new \Think\Page($count,10);
                $show       = $Page->show();// 分页显示输出
                $list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                    ->field("h_user.nickname,h_record.id,h_record.s_time,time_length,evaluation,hrvmark,timetype")
                    ->order('h_record.id asc')
                    ->limit($Page->firstRow.','.$Page->listRows)
                    ->select();
            }else{
                $n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                    ->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                    ->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")
                    ->order('h_record.id asc')
                    ->where("h_user.jl_id='$_SESSION[id]'")
                    ->limit($Page->firstRow.','.$Page->listRows)->select();
                $count      = count($n);
                $Page       = new \Think\Page($count,10);
                $show       = $Page->show();// 分页显示输出
                $list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")
                    ->field("h_user.nickname,h_record.id,h_record.s_time,time_length,evaluation,hrvmark,timetype")
                    ->where("h_user.jl_id='$_SESSION[id]'")
                    ->order('h_record.id asc')
                    ->limit($Page->firstRow.','.$Page->listRows)
                    ->select();
            }
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
        if($_SESSION['id']==1){
            $m=D('organization');
            $group=$m->select();
        }else{
            $m=D('organization');
            $group=$m->where("jl_id='$_SESSION[id]'")
                ->select();
        }

        $sel = M('Record')->distinct(true)->field('timetype')->select();

        $this->assign("group",$group);
        $this->assign("sel",$sel);
        $this->assign("count",$count);
        $this->assign("list",$list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display("record");
    }
//public function recordSearch(){
//		$name = I('post.uname','','trim');
//		$sel = I('post.sel','','trim');
//		$time = I('post.time','','trim');
//		$m = M("Record");
//			if ($name != null && $sel == null && $time == null) {
//				//echo "有名字";
//				$n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where("h_user.nickname like '$name'")->limit($Page->firstRow.','.$Page->listRows)->select();
//	            $count      = count($n);
//	           	$Page       = new \Think\Page($count,10);
//	           	$show       = $Page->show();// 分页显示输出
//				$list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where("h_user.nickname like '$name' ")->limit($Page->firstRow.','.$Page->listRows)->select();
//			}else if ($name == null && $sel  != null && $time == null) {
//				//echo "有类型";
//				$n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where(" timetype = '$sel'")->limit($Page->firstRow.','.$Page->listRows)->select();
//	            $count      = count($n);
//	           	$Page       = new \Think\Page($count,10);
//	           	$show       = $Page->show();// 分页显示输出
//				$list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where("timetype = '$sel'")->limit($Page->firstRow.','.$Page->listRows)->select();
//			}else if ($name == null && $sel == null && $time != null) {
//				//echo "有时间";
//				$n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where(" h_record.rtime like '%$time%' ")->limit($Page->firstRow.','.$Page->listRows)->select();
//	            $count      = count($n);
//	           	$Page       = new \Think\Page($count,10);
//	           	$show       = $Page->show();// 分页显示输出
//				$list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where(" h_record.rtime like '%$time%' ")->limit($Page->firstRow.','.$Page->listRows)->select();
//			}else if ($name != null && $sel  != null && $time != null) {
//				$n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where("h_user.nickname like '$name' && h_record.rtime like '%$time%' && timetype = '$sel'")->limit($Page->firstRow.','.$Page->listRows)->select();
//	            $count      = count($n);
//	           	$Page       = new \Think\Page($count,10);
//	           	$show       = $Page->show();// 分页显示输出
//				$list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where("h_user.nickname like '$name' && h_record.rtime like '%$time%' && timetype = '$sel'")->limit($Page->firstRow.','.$Page->listRows)->select();
//			}else if ($name != null && $sel  != null && $time == null) {
//				//echo "名字类型";
//				$n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where("h_user.nickname like '$name'  && timetype = '$sel'")->limit($Page->firstRow.','.$Page->listRows)->select();
//	            $count      = count($n);
//	           	$Page       = new \Think\Page($count,10);
//	           	$show       = $Page->show();// 分页显示输出
//				$list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where("h_user.nickname like '$name'  && timetype = '$sel'")->limit($Page->firstRow.','.$Page->listRows)->select();
//			}else if ($name != null && $sel  == null && $time != null) {
//				//echo "名字时间";
//				$n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where("h_user.nickname like '$name' && h_record.rtime like '%$time%' ")->limit($Page->firstRow.','.$Page->listRows)->select();
//	            $count      = count($n);
//	           	$Page       = new \Think\Page($count,10);
//	           	$show       = $Page->show();// 分页显示输出
//				$list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where("h_user.nickname like '$name' && h_record.rtime like '%$time%' ")->limit($Page->firstRow.','.$Page->listRows)->select();
//			}else if ($name == null && $sel  != null && $time != null) {
//				//echo "类型时间";
//				$n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where(" h_record.rtime like '%$time%' && timetype = '$sel'")->limit($Page->firstRow.','.$Page->listRows)->select();
//	            $count      = count($n);
//	           	$Page       = new \Think\Page($count,10);
//	           	$show       = $Page->show();// 分页显示输出
//				$list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->where(" h_record.rtime like '%$time%' && timetype = '$sel'")->limit($Page->firstRow.','.$Page->listRows)->select();
//			}else{
//				//echo "什么都没有";
//				$n = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,report as evaluation,hrvmark,HRVscore,synthesisscore,deflatingindex,timetype,stabilityindex,pressureindex")->order('h_record.id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
//	            $count      = count($n);
//	           	$Page       = new \Think\Page($count,10);
//	           	$show       = $Page->show();// 分页显示输出
//				$list = $m->join("LEFT JOIN h_user ON h_user.id = h_record.user_id")->field("h_user.nickname,h_record.id,h_record.s_time,time_length,evaluation,hrvmark,timetype")->order('h_record.id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
//			}
//
//			foreach ($list as $key => $v) {
//	           	$time = $v['time_length'];
//				if(is_numeric($time)){
//				    $value = array(
//				      "years" => 0, "days" => 0, "hours" => 0,
//				      "minutes" => 0, "seconds" => 0,
//				    );
//				    if($time >= 31556926){
//				      $value["years"] = floor($time/31556926);
//				      $time = ($time%31556926);
//				    }
//				    if($time >= 86400){
//				      $value["days"] = floor($time/86400);
//				      $time = ($time%86400);
//				    }
//				    if($time >= 3600){
//				      $value["hours"] = floor($time/3600);
//				      $time = ($time%3600);
//				    }
//				    if($time >= 60){
//				      $value["minutes"] = floor($time/60);
//				      $time = ($time%60);
//				    }
//				    $value["seconds"] = floor($time);
//				    $times = $value["hours"] ."小时". $value["minutes"] ."分".$value["seconds"]."秒";
//
//				}else{
//				    //echo "error";
//				}
//				$list[$key]['time_length'] = $times;
//
//           	}
//			$sel = M('Record')->distinct(true)->field('timetype')->select();
//           	//print_r($list);exit("hello");
//			$this->assign("sel",$sel);
//			$this->assign("count",$count);
//			$this->assign("list",$list);
//			$this->assign('page',$show);// 赋值分页输出
//			$this->display("record");
//	}
	    public function index(){
        $Model=D('jingli');
        $data=$Model->where("id='$_SESSION[id]'")->find();
        // $zhanghu=count($Model->where("id not in(1)&& status=0")->select());
        // $data['zhanghu']=$zhanghu;
        // $frost=count($Model->where("id not in(1) && status=1")->select());
        // $total=count($Model->where("id not in(1)")->select());
        // $data['total']=$total;
        // $data['frost']=$frost;
        $this->assign('data',$data);
        $this->display();

    }
}