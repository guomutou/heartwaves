<?php

namespace Home\Controller;

use Think\Controller;

include "GModel.php";
class WebController extends MyBaseController {
	//幸运大转盘
	public function draw(){
        $uid = I('param.uid','','trim');
        $gold = M('user')->where('id='.$uid)->getField('gold');

        $this->assign('gold',$gold);
        $this->assign('uid',$uid);
		$this->display();
	}
	//在线提问
	public function online(){
        // $this->display();exit();
        $data['user_id']  = I ('param.uid','','trim');
        // $data['user_id']  = 4;

        $list = D('chat')->where($data)->order('id asc')->limit(1000)->select();
        // dump($list);exit();
        $this->assign('list',$list);
        $uid = $data['user_id'];
        $this->assign('uid',$uid);

		$this->display();
	}
    public function onlineSub(){
        $data['user_id']  = I ('param.uid','','trim');
        $data['question'] = I ('param.content','','trim');
        $data['time']    = time();
        $list = D('chat')->add($data);

        $result['data']=$list;
        $result['message']='请求成功';
        GResult::getInstance()->echoOkAndResult($result);exit();    
        
    }

    public function onlines(){
        // $this->display();exit();
        $data['user_id']  = I ('param.uid','','trim');
        // $data['user_id']  = 4;

        $list = D('chat')->where($data)->order('id desc')->limit(1)->select();
        $result['data']=$list;
        $result['message']='请求成功';
        GResult::getInstance()->echoOkAndResult($result);exit();  
    }


	//老虎机
	public function SlotsCasino(){
        $uid = I('param.uid','','trim');
        $gold = M('user')->where('id='.$uid)->getField('gold');

        $this->assign('gold',$gold);
        $this->assign('uid',$uid);
	    $this->display();

    }
    //老虎机-扣金豆
    public function Slots(){
        $uid = I('param.uid','','trim');
        M('user')->where('id ='.$uid)->setDec('gold',10);
        $gold = M('user')->where('id='.$uid)->getField('gold');
        $d['data'] =  $gold;
        return GResult::getInstance()->echoOkAndResult($d);
    }
    //老虎机-加金豆
    public function Slotss(){
        $uid = I('param.uid','','trim');
        $gold = I('param.gold','','trim');
        M('user')->where('id ='.$uid)->setInc('gold',$gold);
        $gold = M('user')->where('id='.$uid)->getField('gold');
        $d['data'] =  $gold;
        return GResult::getInstance()->echoOkAndResult($d);
    }
    public function authorise(){
    //是否授权
        $uid  =I ( 'param.openid', '', 'trim' );
        $time=time();//当天时间戳
        $last_time=strtotime('-3 day');   //三天前的时间戳
        $userModel=D('qipai_user.user');
        $whether=$userModel
            ->field('_id,openid,icon,sex,username,last_time')
            ->where("openid ='$uid'")
            ->find();

        if(! $uid){
            $data['message']='缺少参数';
            GResult::getInstance()->echoErro1AndMessage($data);die();
        }
        if($whether){
            $info=$whether['last_time']>$last_time;
            if($info){
                            $da=$userModel->where("openid='$whether[openid]'")->save(['last_time'=>$time]);
                $data['user_info']=$whether;
                $data['message']='已经授权了 ';
                $data['accredit']=1;//是否过期 0 过期   1 已经授权   2授权时间已过   请重新授权
                $data['time']=1;
                GResult::getInstance()->echoOkAndResult($data);
                }else{
                $data['message']='授权已过期';
                $data['time']=0; //授权过期重新授权
                $data['accredit']=1;//是否过期  0过期 请重新授权
                GResult::getInstance()->echoOkAndResult($data);
            }
        }
        else{
            $data['message']='用户不存在 请授权';
            $data['accredit']=0;//是否过期 0 过期   1 已经授权   2授权时间已过   请重新授权
            $data['time']=0;
            GResult::getInstance()->echoOkAndResult($data);
        }

    }
    public function test(){
//	    //第一次授权
    $uid  =I ( 'param.uid', '', 'trim' );
    $headurl =I ( 'param.headurl', '', 'trim' );
    $sex  =I ( 'param.sex', '', 'trim' );
    $username  =I ( 'param.username', '', 'trim' );
    $orgname  =I ( 'param.orgName', '', 'trim' );
    $time=time();//当天时间戳
    $last_time=strtotime('-3 day');   //三天前的时间戳
    $userModel=D('qipai_user.user');
    $whether=$userModel
        ->field('_id,id,openid,icon,sex,username,last_time,orgname')
        ->where("openid ='$uid'")
        ->find();
    if($whether){
        $da=$userModel
            ->where("openid='$whether[openid]'")
            ->save([
                'last_time'=>$time,
                'icon'=>$headurl,
                'sex'=>$sex,
                'username'=>$username,
                'orgname'=>$orgname,
            ]);
            $data['user_info']=$whether;
            $data['accredit']=1;//是否过期
            $data= json_encode($data);
            $this->assign('data',$data);
            $this->display();


    }else{
        $re= $userModel->add([
            'openid'=>$uid,
            'icon'=>$headurl,
            'sex'=>$sex,
            'username'=>$username,
            'last_time'=>$time,
            'orgname'=>$orgname,
        ]);
        if($re){
            $re= $userModel->where("_id='$re'")->save([
                'id'=>$re,
            ]);
            $user=$userModel->field('_id,,id,openid,icon,sex,username,last_time,orgname')->where("openid='$uid'")->find();
            $data['user_info']=$user;
            $data['accredit']=1;//是否过期
            $data=json_encode($data);
            $this->assign('data',$data);
        }
    }
}
    public function replacetest(){
//	    //第一次授权
        $uid  =I ( 'param.openid', '', 'trim' );
        $headurl =I ( 'param.headurl', '', 'trim' );
        $sex  =I ( 'param.sex', '', 'trim' );
        $username  =I ( 'param.username', '', 'trim' );
        $orgname  =I ( 'param.orgname', '', 'trim' );
        $time=time();//当天时间戳
        $last_time=strtotime('-3 day');   //三天前的时间戳
        $userModel=D('qipai_user.user');
        $whether=$userModel
            ->field('_id,id,openid,icon,sex,username,last_time,orgname')
            ->where("openid ='$uid'")
            ->find();
        if($whether){
            $da=$userModel
                ->where("openid='$whether[openid]'")
                ->save([
                    'last_time'=>$time,
                    'icon'=>$headurl,
                    'sex'=>$sex,
                    'username'=>$username,
                    'orgname'=>$orgname,
                ]);
                $data['user_info']=$whether;
                $data['accredit']=1;//是否过期
                $data= json_encode($data);
                echo $data;
        }else{

            $re= $userModel->add([
                'openid'=>$uid,
                'icon'=>$headurl,
                'sex'=>$sex,
                'username'=>$username,
                'last_time'=>$time,
                'orgname'=>$orgname,
            ]);
            if($re){
                $re= $userModel->where("_id='$re'")->save([
                    'id'=>$re,
                ]);
                $user=$userModel->field('_id,,id,openid,icon,sex,username,last_time,orgname')->where("openid='$uid'")->find();
                $data['user_info']=$user;
                $data['accredit']=1;//是否过期
                $data=json_encode($data);
                $this->assign('data',$data);
            }
        }
    }
    public function capture(){
        $uid=I('param.uid','', 'trim' );
        //初始化
        if(! $uid){
            $data['message']='缺少参数';
            GResult::getInstance()->echoErro1AndMessage($data);die();
        }
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, 'http://124.205.214.69:10510/e-thirdparty/thirdparty/friendList');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "Content-type: application/json;charset='utf-8'",
           )
        );
        //设置头文件的信息作为数据流输出
        //curl_setopt($curl, CURLOPT_HEADER, 1);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_NOBODY, 1);//不返回response body内容
        //设置post数据
        $post_data = array(
            'user_id'=>$uid,
        );
        $post_data=json_encode($post_data);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        $data = curl_exec($curl);
        //关闭URL请求
        $data=json_decode($data,true);
        //抓取数据有 解码后为null
        curl_close($curl);
        $userModel=D('qipai_user.user');
        $friModel=D('qipai_user.friends');
        $udata=$userModel->where("openid='$uid'")->find();
        foreach($data['data'] as $key =>$value  ){
            $a=$userModel->where("openid='$value[user_id]'")->find();
            if($value['user_id']==$a['openid']){
                continue  ;
            }else{
                $result[]=$userModel->add([
                'openid'=>$value['user_id'],
                'icon'=>$value['head_url'],
                'username'=>$value['user_name'],
            ]);
            }
        }
        foreach ($result as $value){
            $re= $userModel->where("_id='$value'")->save([
                'id'=>$value,
            ]);

        }
        $uid =$udata['_id'];
            $c= $friModel->where(array('uid'=>$uid,'state'=>2)) -> select();
            foreach($c as $value){
                            $friend_id[]= $value['fid'];
                        }
            $f= $friModel->where(array('fid'=>$uid,'state'=>2)) -> select();
                        foreach($f as $value){
                            $friend_id[]= $value['uid'];
                        }
          foreach ($result as $haoyou) {
            if(in_array($haoyou, $friend_id)){
                continue;
            }
                $da=$friModel->add([
                    'uid'=>$udata['_id'],
                    'fid'=>$haoyou,
                    'state'=>2,
                ]);
        }
        $result['message']='请求成功';
        GResult::getInstance()->echoOkAndResult($result);
    }
}