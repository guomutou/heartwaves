<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
    	$this->display();
    }
    public  function checklogin(){
    	$username = $_POST['username'];
    	$password = md5(md5($_POST['password']));
    	//var_dump($password);
    	/*$kouling = $_POST['kouling'];*/
    	$M = M('jingli');
        $result = $M->where("username='%s' AND password='%s' AND status ='0'",$username,$password)->find();
        if(empty($result)){
             $this->error('登陆失败');
        }
        $time=time();
                if($result['id'] ==1){
                    $_SESSION['id'] = $result['id'];
                    $_SESSION['username'] = $result['username'];
                     $_SESSION['lat_time'] = $result['lat_time'];
                    $_SESSION['kouling'] = md5(md5($result['kouling']));
               $data = $M->where("id='$result[id]'")->save([
              'lat_time'=>$time
                ]);      
                   $this->success('登陆成功',U('Admin/Index/index'),3);
               }
               
        if($result['id'] !=1){
             if($result['end_time']>$time){
                $_SESSION['id'] = $result['id'];
                $_SESSION['lat_time'] = $result['lat_time'];
                $_SESSION['username'] = $result['username'];
                $_SESSION['kouling'] = md5(md5($result['kouling']));
                 $data = $M->where("id='$result[id]'")->save([
                'lat_time'=>$time
                ]);     
               $this->success('登陆成功',U('Admin/Index/index'),3);
        }else{
                  $data = $M->where("id='$result[id]'")->save([
                'status'=>1
            ]);      
            $this->error('登陆失败');
        }  
        }

//        echo M()->getLastSql()
//        var_dump($result);
//        echo M()->getLastSql();die();
    	/*$result = $M->where("username='%s' AND password='%s' AND kouling='%s' AND status ='0'",$username,$password,$kouling)->find();*/
//    	var_dump($result);die();

    }

    public  function logout(){
    	session(null);
    	$this->success('欢迎再来',U('Admin/Login/login'),3);
    }

}
