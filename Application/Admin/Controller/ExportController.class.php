<?php 
namespace Admin\Controller;
use Think\Controller;
class ExportController extends Controller{
	
	public function upload(){
    //import('ORG.Util.ExcelToArrary');//导入excelToArray类
    /*if (! empty ( $_FILES ['file_stu'] ['name'] )){

       import('ORG.Net.UploadFile');
       $upload = new UploadFile();// 实例化上传类
       $upload->maxSize  = 3145728 ;// 设置附件上传大小
       $upload->allowExts  = array('xls', 'xlsx');// 设置附件上传类型
       $upload->savePath =  './';// 设置附件上传目录
      if(!$upload->upload()) {// 上传错误提示错误信息
            $this->error($upload->getErrorMsg());
            }else{// 上传成功 获取上传文件信息
                $info =  $upload->getUploadFileInfo();
            }
   }else{
       $this->error('(⊙o⊙)~没传数据就导入?!你在逗我?!');
   }*/
        //dump($info);die;
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     3145728 ;// 设置附件上传大小
		$upload->exts      =     array('xls', 'xlsx');// 设置附件上传类型
		 //$upload->allowExts  = array('xls', 'xlsx');// 设置附件上传类型
		$upload->rootPath  =     './Public'; // 设置附件上传根目录
		$upload->savePath  =     'Uploads/'; // 设置附件上传（子）目录
    // 上传文件 
		$info   =   $upload->upload();
		//var_dump($info);die;
    if(!$info) {// 上传错误提示错误信息
        $this->error($upload->getError());
    }else{// 上传成功
        $this->success('上传成功！');
    }
}
		
		
  // $ExcelToArrary=new ExcelToArrary();//实例化  
   $res=ExcelToArrary::read($info[0]['savepath'].$info[0]['savename'],"UTF-8",$info[0]['extension']);//传参,判断office2007还是office2003
   var_dump($res);die;
   $res = array_slice($res,1); //为了去掉Excel里的表头,也就是$res数组里的$res[0];
   //dump($res);
   foreach ( $res as $k => $v ){ //循环excel表
        $data[$k]['name'] = $v [0];//创建二维数组  
        $data[$k]['tel'] = $v [1];  
        $data[$k]['kind'] = $v [2];
    }
     //dump($data);die;
    $result=M('Player')->addAll($data);  
    if(!$result){  
        $this->error('导入数据库失败');  
        exit();  
    }else{
         $filename = './'.$info[0]['savename'];//上传文件绝对路径,unlink()删除文件函数
         if (unlink($filename)) {
             $this->success ( '导入成功' ); 
         }else{
             $this->error('缓存删除失败');
			}
		}  
	}
 }
 ?>