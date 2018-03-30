<?php
namespace Admin\Controller;
use Think\Controller;
class ViewController extends CommonController {
    public function index(){
            $m=M("muban");
            $arr = $m->order("id desc")->select();
            $this->assign("arr",$arr);
    	$this->display();
    }

    public function add(){
    	$fl = M("slides")->field("name,id")->select();
    	$this->assign("fl",$fl);
        $this->display();
    }

    public function doadd(){
        $m = M("muban");
        $data = $m->create();
        $data['addtime']=time();
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =      './Public/Uploads/'; // 设置附件上传目录    // 上传文件
        $info1   =   $upload->uploadOne($_FILES['pic1']);
        $info2   =   $upload->uploadOne($_FILES['pic2']);
        $info3   =   $upload->uploadOne($_FILES['pic3']);
        $info4   =   $upload->uploadOne($_FILES['pic4']);
        $info5   =   $upload->uploadOne($_FILES['pic5']);
        /*if(!$info1|| !$info2 ||!$info3 ||!$info4 ||!$info5 ) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功*/
            $data['pic1']="http://120.27.98.52/helpme/Public/Uploads/".$info1['savepath'].$info1['savename'];
            $data['pic2']="http://120.27.98.52/helpme/Public/Uploads/".$info2['savepath'].$info2['savename'];
            $data['pic3']="http://120.27.98.52/helpme/Public/Uploads/".$info3['savepath'].$info3['savename'];
            $data['pic4']="http://120.27.98.52/helpme/Public/Uploads/".$info4['savepath'].$info4['savename'];
            $data['pic5']="http://120.27.98.52/helpme/Public/Uploads/".$info5['savepath'].$info5['savename'];
            $result = $m->add($data);
            if($result>0){
                $this->success("发布成功！",U('slides/index'),3);
            }else{
                $this->error("发布失败！");
        /*}*/
    }
}
    public function delete(){
        $m=M("muban");
        $id = $_GET['id'];
        $result = $m->delete($id);
        if($result>0){
            $this->success("删除成功！");
        }else{
            $this->error("删除失败！");
        }
    }


    public function edit(){
        $id = $_GET['id'];
        $m=M("muban");
        $arr = $m->where("id = {$id}")->find();
        $this->assign("arr",$arr);
        $this->display();
    }

    public function doedit(){
        $id = $_GET['id'];
        $m = M("muban");
        $data = $m->create();
        if(1==0){
            
        }else{
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =      './Public/Uploads/'; // 设置附件上传目录    // 上传文件
            $info1   =   $upload->uploadOne($_FILES['pic1']);
	        $info2   =   $upload->uploadOne($_FILES['pic2']);
	        $info3   =   $upload->uploadOne($_FILES['pic3']);
	        $info4   =   $upload->uploadOne($_FILES['pic4']);
	        $info5   =   $upload->uploadOne($_FILES['pic5']);
            
            if(!$info1) {// 上传错误提示错误信息
            
            }else{// 上传成功
                $data['pic1']="http://120.27.98.52/helpme/Public/Uploads/".$info1['savepath'].$info1['savename'];
            }
            if(!$info2) {// 上传错误提示错误信息
            
            }else{// 上传成功
                $data['pic2']="http://120.27.98.52/helpme/Public/Uploads/".$info2['savepath'].$info2['savename'];
            }
            if(!$info3) {// 上传错误提示错误信息
            
            }else{// 上传成功
                $data['pic3']="http://120.27.98.52/helpme/Public/Uploads/".$info3['savepath'].$info3['savename'];
            }
            if(!$info4) {// 上传错误提示错误信息
            
            }else{// 上传成功
                $data['pic4']="http://120.27.98.52/helpme/Public/Uploads/".$info4['savepath'].$info4['savename'];
            }
            if(!$info5) {// 上传错误提示错误信息
            
            }else{// 上传成功
                $data['pic5']="http://120.27.98.52/helpme/Public/Uploads/".$info5['savepath'].$info5['savename'];
            }
        }
        
        $result = $m->where("id = {$id}")->save($data);
        
        if($result>0){
            $this->success("修改成功！",U('view/index'),3);
        }else{
            $this->error("修改失败！");
        }
    }













}
