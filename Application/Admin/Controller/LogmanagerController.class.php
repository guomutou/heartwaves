<?php
namespace Admin\Controller;
use Think\Controller;
class LogmanagerController extends Controller{
	public function log(){
		 $m = M("Log");
            	 $count      = $m->count();
           	 $Page       = new \Think\Page($count,2);
           	 $show       = $Page->show();// 分页显示输出
           	 $list = $m->order('id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
		 $this->assign("list",$list);
           	 $this->assign('page',$show);// 赋值分页输出
		$this->display();
	}
	public function deleteMany(){
		//$m[] = I('post.m','','trim');
		$m = implode(",",$_POST['m']);
		$where['id'] = array('in',$m);
		$bool = M('Log')->where($where)->delete();
		if($bool){
			$this->success("删除成功!",U("Logmanager/log"),3);
		}else{
			$this->error("删除失败!");
		}
	}
	public function logSearch(){
		$str = I('get.str','','trim');
		 $m = M("Log");
            	 $count      = $m->count();
           	 $Page       = new \Think\Page($count,2);
           	 $show       = $Page->show();// 分页显示输出
           	 $list = $m->order('id asc')
			 ->where("detail like '%$str%'")
			 ->limit($Page->firstRow.','.$Page->listRows)->select();
		 $this->assign("list",$list);
           	 $this->assign('page',$show);// 赋值分页输出
		$this->display("log");
	}
	public function deleteLog(){
		$id = I('get.id','','trim');
		$bool = M('Log')->where("id = $id")->delete();
		if($bool){
			$this->success("删除成功!",U('Logmanager/log'),3);
		}else{
			$this->error("删除失败!");
		}
	}
}
