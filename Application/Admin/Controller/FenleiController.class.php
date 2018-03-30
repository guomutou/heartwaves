<?php
namespace Admin\Controller;
use Think\Controller;
class FenleiController extends CommonController {
    public function index(){
            $m=M("fenlei");
            $arr = $m->where("fid = 0")->select();
            $arr2 = $m->where("fid != 0")->select();
            $this->assign("arr",$arr);
            $this->assign("arr2",$arr2);
    	$this->display();
    }

    public function catadd(){
    	$this->display();
    }

    public function add(){
        $m=M("fenlei");
        $arr = $m->where("fid=0")->select();
        $this->assign("arr",$arr);
        $this->display();
    }

    public function doadd(){
        $m = M("fenlei");
        $result = $m->add($m->create());
        if($result>0){
            $this->success("添加成功！",U('fenlei/index'),3);
        }else{
            $this->error("添加失败！");
        }
    }

    public function delete(){
        $m=M("fenlei");
        $id = $_GET['id'];
        $check = $m->where("fid= {$id}")->find();
        if($check != null){
            $this->error("你小弟还没清理干净呢");
        }else{
            $result = $m->delete($id);
        }
        if($result>0){
            $this->success("删除成功！",U('fenlei/index'),3);
        }else{
            $this->error("删除失败！");
        }
    }


    public function edit(){
        $id = $_GET['id'];
        $m=M("fenlei");
        $arr = $m->where("id = {$id}")->find();
        $this->assign("arr",$arr);
        $arrs = $m->where("fid = 0")->select();
        $this->assign("arrs",$arrs);
        $this->display();
    }

    public function doedit(){
        $id = $_GET['id'];
        $m = M("fenlei");
        $result = $m->where("id = {$id}")->save($m->create());
        if($result>0){
            $this->success("修改成功！",U('fenlei/index'),3);
        }else{
            $this->error("修改失败！");
        }
    }













}
