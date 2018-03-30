<?php
namespace Admin\Controller;
use Think\Controller;
class SiteController extends CommonController {
    public function index(){
        $m = M("site");
        $arr = $m->find(1);
        $this->assign("arr",$arr);
        $this->display();
    }

    public function doedit(){
        $m = M("site");
        $data = $m->create();
        $data['statistics']= $_POST['statistics'];
        if(empty($_FILES['logo']['name'])){
            unset($data['logo']);
        }else{
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =      './Public/Uploads/'; // 设置附件上传目录    // 上传文件
            $info   =   $upload->uploadOne($_FILES['logo']);
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
                $data['logo']=$info['savepath'].$info['savename'];
            }
        }
        $result = $m->where("id = 1")->save($data);
        if($result){
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }

    public function url(){
        $urlSite = C("URL_MODEL");
        $this->assign("urlSite",$urlSite);
        $this->display();
    }

}
