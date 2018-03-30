<?php
namespace Admin\Controller;
use Think\Controller;
class GonggaoController extends CommonController {
    public function index(){
            $m=M("gonggao");
            $arr = $m->where("jl_id='$_SESSION[id]'")->order("ctime desc")->select();
            $this->assign("arr",$arr);
    	$this->display();
    }

    public function add(){
        $this->display();
    }

    public function doadd(){
        $m = M("gonggao");
        $data = $m->create();
        $data['ctime']=date("Y-m-d H:i:s");
        $data['jl_id']=$_SESSION['id'];
        $result = $m->add($data);
        if($result>0){
            $this->success("添加成功！",U("Gonggao/index"),3);
        }else{
            $this->error("添加失败！");
        }
    }

    public function delete(){
        $m=M("gonggao");
        $id = $_GET['id'];
        $result = $m->delete($id);
        if($result>0){
            $this->success("删除成功！",U("Gonggao/index"),3);
        }else{
            $this->error("删除失败！");
        }
    }

    public function edit(){
        $id = $_GET['id'];
        $m=M("gonggao");
        $arr = $m->where("id = {$id}")->find();
        $this->assign("arr",$arr);
        $this->display();
    }

    public function doedit(){
        $id = $_GET['id'];
        $data['content'] = I("param.content","","trim");
        $data['title'] = I("param.title","","trim");
        $data['ctime']=date("Y-m-d H:i:s");
        $m = M("gonggao");
        $result = $m->where("id = {$id}")->save($data);
        if($result>0){
            $this->success("修改成功！",U("Gonggao/index"),3);
        }else{
            $this->error("修改失败！");
        }
    }













}
