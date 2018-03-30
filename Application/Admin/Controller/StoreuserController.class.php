<?php
namespace Admin\Controller;
use Think\Controller;
class StoreuserController extends Controller{
	public function index(){
		if($_POST){
		$name = I('post.ss');
	   $m = M("Store");
            $count      = $m->where("status = 0")->count();
            $Page       = new \Think\Page($count,10);
            $show       = $Page->show();// 分页显示输出
            $list = $m->where("nickname = $name")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign("list",$list);
            $this->assign('page',$show);// 赋值分页输出
    	   $this->display();
		}
	}
}