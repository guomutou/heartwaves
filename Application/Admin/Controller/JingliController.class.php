<?php
namespace Admin\Controller;
use Think\Controller;
class JingliController extends CommonController {
    //普通管理员列表
    public function jinglilist(){
            $model = M("jingli");
            $count=count($model  ->where(" id != 1")->select());

            $Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
            $show       = $Page->show();// 分页显示输出
            // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
            $data=$model
                ->alias('a')
                ->field('a.*,COUNT(b.id) as yonghu')
                ->join('LEFT  JOIN  __USER__ AS b on a.id=b.jl_id ')
                ->where(" a.id != 1")
                ->group('a.id')
                ->limit($Page->firstRow.','.$Page->listRows)
                ->select();
            $time=(string)time();//当前时间时间戳
            foreach($data as $key=>$value){
            $data[$key]['shijian']=$value['end_time']-time();
            }
            $this->assign('page',$show);// 赋值分页输出
            $this->assign('data',$data);
             $this->assign('count',$count);
            $this->display();
    }
    //添加普通管理员
    public function addjingli(){
        if(IS_POST){
//            var_dump($_POST);
            $username=I('post.username');
            $password=md5(I('post.password'));
            $create_time=time();
            $endtime=strtotime(I('post.endtime'));
            $user_num=I('post.user_num');
            $status=I('post.status');
            $kouling=I('post.kouling');
            $lat_time=time();
            $Model=D('jingli');
            $re=$Model->where("username='$username'")->find();
            if($re){
                $this->error('有重复名请换个名字',U('jinglilist'),5);
            }
            $data=$Model->add([
                'username'=>$username,
                'password'=>md5(md5('123456')),
                'create_time'=>$create_time,
                'user_num'=> $user_num,
                'status'=>$status,
                'kouling'=>'',
                'end_time'=>$endtime,
                'kouling'=>$kouling,
                'lat_time'=>$lat_time,
            ]);
            if ($data){
                $JsModel=D('Js');
                $dataList[] = array('name'=>'初级学员','fid'=>'1,6,24,25,26,27,28,29,7,18,19,20,21,22,23,8,30,31,32,33,34,35,9,36,37,38,2,39,40,41,56,57,58,59,3,43,60,61,62,63,44,64,65,66,67,4,45,46,47,48,49,50,5,10,11,12,14,15,16,17,13,69','ctime'=>date('Y-m-dH:i:s',time()),'description'=>'初级训练','jcode'=>'','jl_id'=>$data);
                $dataList[] = array('name'=>'中级学员','fid'=>'1,6,24,25,26,27,28,29,7,18,19,20,21,22,23,8,30,31,32,33,34,35,9,36,37,38,2,39,40,41,56,57,58,59,3,43,60,61,62,63,44,64,65,66,67,4,45,46,47,48,49,50,5,10,11,12,14,15,16,17,13,69','ctime'=>date('Y-m-dH:i:s',time()),'description'=>'中级训练内容','jcode'=>'manager','jl_id'=>$data);
                $dataList[] = array('name'=>'高级学员','fid'=>'1,6,24,25,26,27,28,29,7,18,19,20,21,22,23,8,30,31,32,33,34,35,9,36,37,38,2,39,40,41,56,57,58,59,3,43,60,61,62,63,44,64,65,66,67,4,45,46,47,48,49,50,5,10,11,12,14,15,16,17,13,69','ctime'=>date('Y-m-dH:i:s',time()),'description'=>'开启全部训练','jcode'=>'','jl_id'=>$data);
                $dataList[] = array('name'=>'管理员','fid'=>'1,6,24,25,26,27,28,29,7,18,19,20,21,22,23,8,30,31,32,33,34,35,9,36,37,38,2,39,40,41,56,57,58,59,3,43,60,61,62,63,44,64,65,66,67,4,45,46,47,48,49,50,5,10,11,12,14,15,16,17,13,69','ctime'=>date('Y-m-dH:i:s',time()),'description'=>'全部功能可用','jcode'=>'','jl_id'=>$data);
                $dataList[] = array('name'=>'游客','fid'=>'1,6,24,25,26,27,28,29,7,18,19,20,21,22,23,8,30,31,32,33,34,35,9,36,37,38,2,39,40,41,56,57,58,59,3,43,60,61,62,63,44,64,65,66,67,4,45,46,47,48,49,50,5,10,11,12,14,15,16,17,13,69','ctime'=>date('Y-m-dH:i:s',time()),'description'=>'只能体验少部分功能','jcode'=>'','jl_id'=>$data);
                $JsModel->addAll($dataList);
                $this->success('添加成功',U('jinglilist'));
            }
        }

        $this->display();
    }
    //修改普通管理员
    public function editjingli(){
        $Model=D('jingli');
        if(IS_POST){
        $id=I('post.id');
          $username=I('post.username');
//            $password=md5(I('post.password'));
//            $create_time=I('post.create_time');
            $user_num=I('post.user_num');
            $status=I('post.status');
            $endtime=I('post.endtime');
            $endtime=strtotime($endtime);

//
//            $re=$Model->where("in (id='$id') '")->find();
//            //echo M()->getLastSql();die;
//            if($re){
//                $this->error('有重复名请换个名字','/addjingli',5);
//            }
            $data=$Model->where("id='$id'")->save([
                'username'=>$username,
                'user_num'=> $user_num,
                'status'=>$status,
                'end_time'=>$endtime,
            ]);
            if ($data){
                $this->success('修改成功',U('jinglilist'));
            }
        }
//        $this->display();
    }
    //搜索普通管理员
    public  function searchjingli(){
        $m = M("jingli");
        $str =I('post.search');
        $count      = $m->count();
        $Page       = new \Think\Page($count,20);
        $show       = $Page->show();// 分页显示输出
        $show       = $Page->show();// 分页显示输出
//        var_dump($str);die();
        $data = $m
            ->where("username like '%$str%'")
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();

        $this->assign("data",$data);
        $this->assign('page',$show);// 赋值分页输出
        $this->display('jinglilist');
    }
    //超级管理员 详情
    public function index(){
        $Model=D('jingli');
        $data=$Model->where("id='$_SESSION[id]'")->find();
        $zhanghu=count($Model->where("id not in(1)&& status=0")->select());
        $data['zhanghu']=$zhanghu;
        $frost=count($Model->where("id not in(1) && status=1")->select());
        $total=count($Model->where("id not in(1)")->select());
        $data['total']=$total;
        $data['frost']=$frost;
        $this->assign('data',$data);
        $this->display();

    }
    //修改管理员姓名
        public  function editname()
    {
           
              if(IS_POST){
                   $Model=D('jingli');
                $id=I('post.id');
                $username=I('post.username');
                $password=I('post.password');
     
             $data=$Model->where("id='$id'")->save([
                'username'=>$username,
                 'password' =>md5(md5($password)),
            ]);
                // var_dump($_POST);die();                
            if ($data){
                if($id==1){
                    $this->success('修改成功',U('jinglilist'));
                }else{
                     $this->success('修改成功',U('Organizeconstruct/index'));
                }
                
            }
          

        }
    }
        //修改管理员密码
        public  function editpassword($id ,$pass)
    {


            $Model=D('jingli');
            $data = $Model->where("id='$id'")->save([
                'password' => md5(md5($pass))
                ]);
            $data['data']=200;
            $this->ajaxReturn($data,'JSON');
    }
        //删除普通管理员
    public  function deleteorg(){
        $m = M("jingli");
        $id =I('get.id');

        $data = $m
            ->where("id='$id'")
            ->delete();
            //echo M()->getlastsql();
            
 $this->success('删除普通管理员成功',U('jinglilist'));
    }
        //修改普通管理员姓名
        public  function editjingliname()
    {
     
              if(IS_POST){
                   $Model=D('jingli');
                $id=I('post.id');
                $username=I('post.name');
     
             $data=$Model->where("id='$id'")->save([
                'username'=>$username,
            ]);
            //     // var_dump($_POST);die();                
            // if ($data){
            //     $this->success('修改成功',U('jinglilist'));
            // }
        }
    }
      //修改普通管理员管理人数
        public  function numberofpeople()
    {
     
   
              if(IS_POST){
                   $Model=D('jingli');
                $id=I('post.id');
          
                $num=I('post.pass');
     
             $data=$Model->where("id='$id'")->save([
                    'user_num'=>$num
            ]);
                // var_dump($_POST);die();                

        }
    }
          //修改普通管理员到期时间 
        public  function endtime()
    {      
              if(IS_POST){
              $Model=D('jingli');
                $id=I('post.id');
                $end_time=I('post.endtime');
                $end_time = strtotime($end_time);
     // var_dump($id);
     // var_dump($end_time);
     //js选取时间有问题待定
             $data=$Model->where("id='$id'")->save([
                'end_time'=>$end_time,
            ]);
         }
    }
            public  function statuss()
    {      
              if(IS_POST){
              $Model=D('jingli');
                $id=I('post.id');
                $status=I('post.status');

     //js选取时间有问题待定
             $data=$Model->where("id='$id'")->save([
                'status'=>$status,
            ]);
         }
    }
       
       

}