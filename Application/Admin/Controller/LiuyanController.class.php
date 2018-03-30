<?php
namespace Admin\Controller;
use Think\Controller;
class LiuyanController extends CommonController {
    public function index(){
            $m = M("liuyan");
            $count      = $m->count();
            $Page       = new \Think\Page($count,10);
            $show       = $Page->show();// 分页显示输出
        //取出 给当前用户留言的信息
                $list = $m
                    ->alias('a')
                    ->field('a.*,c.username')
                    ->join(  'LEFT JOIN h_jingli as c  ON  a.uid =c.id')
                    ->order('a.id desc')
                    ->limit($Page->firstRow.','.$Page->listRows)
                    ->select();
                $msgids = [];
                $result=[];
                foreach( $list as $key => $value ) {

                    $msgids[] = $value['id'];
                    $result[$value['id']] = $value;
                }
                //取出留言下的回复
           if ($list){

               $replies = M("replies");
               $data = $replies->where("msgid in (".implode(',',$msgids).")  ")->order('postdate desc')->select();
               foreach( $data as $key => $value ){
                   $result[$value['msgid']]['replies'][] = $value;
               }
           }
//                foreach( $result as $key => $value ) {
//                    var_dump($value);
//                    echo $value['content']; //显示留言
//                        foreach( $value['replies'] as $k => $val ) {
//                          echo $val['content'];//显示该留言下的恢复
//               }
//            }
            $this->assign("list",$list);

            $this->assign('page',$show);// 赋值分页输出
    	    $this->display();
    }
        public function putongindex(){
            $m = M("liuyan");
            $count      = $m->count();
            $Page       = new \Think\Page($count,10);
            $show       = $Page->show();// 分页显示输出
        //取出 给当前用户留言的信息
                $list = $m
                    ->alias('a')
                    ->field('a.*,c.username')
                    ->join(  'LEFT JOIN h_jingli as c  ON  a.uid =c.id')
                    ->order('a.id desc')
                    ->where("a.uid='$_SESSION[id]'")
                    ->limit($Page->firstRow.','.$Page->listRows)
                    ->select();
                $msgids = [];
                // var_dump($list);
                $result=[];
                foreach( $list as $key => $value ) {

                    $msgids[] = $value['id'];
                    $result[$value['id']] = $value;
                }
                //取出留言下的回复
           if ($list){

               $replies = M("replies");
               $data = $replies->where("msgid in (".implode(',',$msgids).")  ")->order('postdate desc')->select();
               foreach( $data as $key => $value ){
                   $result[$value['msgid']]['replies'][] = $value;
               }
           }
//                foreach( $result as $key => $value ) {
//                    var_dump($value);
//                    echo $value['content']; //显示留言
//                        foreach( $value['replies'] as $k => $val ) {
//                          echo $val['content'];//显示该留言下的恢复
//               }
//            }
           // var_dump($data);
            $this->assign("list",$list);

            $this->assign('page',$show);// 赋值分页输出
            $this->display();
    }
    public function delete(){
        $id = $_GET['id'];
        $m =M("liuyan");
        $r=M('replies');

        $result = $m->where("id = {$id}")->delete();

        if($result>0){
            $data = $r->where("msgid = {$id}")->delete();
            $this->success("成功！");
        }else{
            $this->error("失败！");
        }
    }
        public function reply(){
        $msg_id=I('get.id');
        $Model=D('replies');
        if(IS_POST){
                $content=I('post.content');
                $msg_id=I('post.id');
                $r=$Model->add([
                    'repliesid'=>'',
                   'uid'=>$_SESSION['id'],
                    'msgid'=> $msg_id,
                    'content'=>$content,
                    'postdate'=>time(),
                ]);
                if($r){
                    $this->success('回复成功');
                }
                }
        $this->assign('data',$msg_id);
        $this->display();
        }
        //留言详情
        public function replydesc()
        {
            $m = M("liuyan");
            $msg_id=I('get.id');
            //取出 给当前用户留言的信息
            $list = $m
                ->alias('a')
                ->field('a.*,c.username')
                ->where("a.id='$msg_id'")
                ->join('LEFT JOIN h_jingli as c  ON  a.uid =c.id')
                ->order('id desc')->select();
            $msgids = [];
            $result = [];
            foreach ($list as $key => $value) {

                $msgids[] = $value['id'];
                $result[$value['id']] = $value;
            }

            //取出留言下的回复
            if ($list) {
                $replies = M("replies");
                $data = $replies->alias('a')
                    ->where("msgid in (" . implode(',', $msgids) . ")  ")
                    ->join('LEFT JOIN h_jingli as c  ON  a.uid =c.id')
                    ->order('postdate desc')->select();
//                echo M()->getLastSql();
//                var_dump($data);
                foreach ($data as $key => $value) {
                    $result[$value['msgid']]['replies'][] = $value;
                }

            }
//            foreach ($result as $key => $value) {
////                var_dump($value);
//                echo $value['content']; //显示留言
//                foreach ($value['replies'] as $k => $val) {
////                    var_dump($value);
//                    echo $val['content'];//显示该留言下的恢复
//                }
//            }
            $this->assign("list",$result);
            $this->display();
        }
        //给超级管理员留言
        public function replyadd(){
            $Model=D('liuyan');
            if (IS_POST){

                $ip=I('post.ip');
                $title=I('post.title');
                $content=I('post.content');
                $uid=$_SESSION['id'];

                $time=time();
                $c=$Model->add([
                    'ip'=>$ip,
                    'title'=>$title,
                    'content'=>$content,
                    'uid'=>$uid,
                    'ctime'=>$time,
                ]);
            }
            $this->display();
        }



}
