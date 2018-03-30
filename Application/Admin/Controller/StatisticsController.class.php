<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Model;
class StatisticsController extends CommonController {
    public function index(){
        $test=count(D('user')->group('id')->select());
        //求出所有管理员下
        $daa= D('record')->field('user_id')->group('user_id')->select();
        foreach ($daa as $v){
            $dat[]=$v['user_id'];
        }
        //找出所有管理员下的记录
            foreach($dat as $k=>$v){
                $da[$v][]= D('record')->alias('a')
                    ->field('CONCAT(TimeType) as huodong, COUNT(CONCAT(TimeType)) as cishu')
                    ->join("LEFT JOIN  h_user as b  ON  a.user_id= b.nickname")
                    ->where("a.user_id='$v'")->group('a.timetype')->select();
            }
        $user=D('user');
        //取出所有活动id  和每个管理员活动的次数
            foreach($da as $key=>$v){
                $name[]=$user->field('nickname')->where(" id='$key'")->find();
                foreach ($name as $k1=> $v1){
                    $data[$name[$k1]['nickname']]=$da[$key][0];
                }
            }
        $this->assign('test',$test);
        $this->assign('data',$data);
    	$this->display();
    }
    public  function ajaxtest()
    {
        $jingli=D('jingli');
          $Model = new Model();
        //检测记录    2,3 //检测记录
        $data1=   $Model->query('select j.username ,count(r.TimeType)  as jiance from h_record  r 
                                          LEFT JOIN h_user u ON u.id= r.user_id  
                                                LEFT JOIN h_jingli j ON j.id=u.jl_id  
                                                   WHERE r.TimeType IN (2,3) GROUP BY j.username');
        //训练记录  $driall=[61,62,63,64,65,66,41,42,43,44,45,46,70,71,72,20]; //训练记录
        $data2=M()->query('select j.username ,count(r.TimeType)  as driall from h_record  r 
                                                                      LEFT JOIN h_user u ON u.id= r.user_id  
                                                                            LEFT JOIN h_jingli j ON j.id=u.jl_id  
                                                                               WHERE r.TimeType IN (61,62,63,64,65,66,41,42,43,44,45,46,70,71,72,20) GROUP BY j.username');
        //其他记录 不属于 检测和 训练的
        $data3=M()->query(' select j.username ,count(r.TimeType)  as qita from h_record  r 
                                                              LEFT JOIN h_user u ON u.id= r.user_id  
                                                                    LEFT JOIN h_jingli j ON j.id=u.jl_id        
                                                                          WHERE r.TimeType  Not  IN (2,3,61,62,63,64,65,66,41,42,43,44,45,46,70,71,72,20) GROUP BY j.username');
        $jldata=$jingli->field('username as name')->select();
        foreach ($jldata as $jlkey=>$jlvalue){
            $jldata[$jlkey]['jiance']=0;
            $jldata[$jlkey]['driall']=0;
            $jldata[$jlkey]['qita']=0;
            foreach ( $data1 as $key=>$value){
                   if(($value['username']==$jlvalue['name'])){
                       $jldata[$jlkey]['jiance']=$value['jiance'];
                   }
                     }
            foreach ( $data2 as $key=>$value){
                if(($value['username']==$jlvalue['name'])){
                    $jldata[$jlkey]['driall']=$value['driall'];
            }
            }
            foreach ( $data3 as $key=>$value){
                if(($value['username']==$jlvalue['name'])){
                    $jldata[$jlkey]['qita']=$value['qita'];
                }
            }
    }

        $data=array_merge($jldata);
        $this -> ajaxReturn($data);
    }

}
