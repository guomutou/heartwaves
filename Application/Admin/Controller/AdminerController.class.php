<?php
namespace Admin\Controller;
use Think\Controller;
class AdminerController extends CommonController {
    public function index(){
            $m = M("jingli");
            $arr = $m->find(1);
            $this->assign("arr",$arr);
            $this->display();
    }

    public function doUpdate(){
	if(isset($_POST['submit'])){
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        $kouling =  $_POST['kouling'];
        if($pass1 != $pass2 || $pass2 == '' || $pass1 == ''){
            $this->error("认真填写");
        }else{
            $data['kouling']= $kouling;
            $data['password']= md5($pass2);
            if($_POST['kouling'] == ''){
                unset($data['kouling']);
            }
            $m = M("jingli");
            $result = $m->where("id = 1")->save($data);
            //$this->myRelust($result);
			$this->success('修改成功,请重新登录!',U('Adminer/index'),3);
			}
		}
	}
}