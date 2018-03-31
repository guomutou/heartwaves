<?php 
namespace Admin\Controller;
use Think\Controller;
class TccController extends Controller{
	public function upload(){
		if (!empty($_FILES)) {
           $config = array(
                'exts' => array('xlsx','xls'),
                'maxSize' => 3145728,
               // 'rootPath' =>"http://120.27.98.52/heartbrain/Public/",
			   'rootPath' =>"./Public/",
                'savePath' => 'Uploads/',
                'subName' => array('date','Ymd'),
           );
           $upload = new \Think\Upload($config);
	 $prx = M("jingli")->where("id = '$_SESSION[id]'")->find();
           if (!$info = $upload->upload()) {
           		$this->error($upload->getError());
           	}
		  		//var_dump($info);die;
            	vendor("PHPExcel.PHPExcel");
				vendor("PHPExcel.PHPExcel.IOFactory");//引入phpexcel类(留意路径,不了解路径可以查看下手册)  
				//Vendor("PHPExcel.PHPExcel.IOFactory"); //引入phpexcel类(留意路径)   
				include "http://120.27.98.52/heartwaves/ThinkPHP/Library/PHPExcel/PHPExcel/IOFactory.php";
				include "http://120.27.98.52/heartwaves/ThinkPHP/Library/PHPExcel/PHPExcel.php";
				include "http://120.27.98.52/heartwaves/ThinkPHP/Library/PHPExcel/PHPExcel/Reader/Excel5.php";
         		$file_name=$upload->rootPath.$info['file_stu']['savepath'].$info['file_stu']['savename'];
         		$extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));//判断导入表格后缀格式
                if ($extension == 'xlsx') {
                    $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
                    $objPHPExcel =$objReader->load($file_name, $encode = 'utf-8');
                } else if ($extension == 'xls'){
                    $objReader = \PHPExcel_IOFactory::createReader('Excel5');
                    $objPHPExcel =$objReader->load($file_name, $encode = 'utf-8');
               	}
               	$sheet =$objPHPExcel->getSheet(0);
               	$highestRow = $sheet->getHighestRow();//取得总行数
        		$highestColumn =$sheet->getHighestColumn(); //取得总列数
      			for ($i = 2; $i <= $highestRow; $i++) {
	         		$data['nickname'] =$objPHPExcel->getActiveSheet()->getCell("A" .$i)->getValue();
	         		$data['sex'] =$objPHPExcel->getActiveSheet()->getCell("B" .$i)->getValue();
					 $data['mobile'] = $objPHPExcel->getActiveSheet()->getCell("C" .$i)->getValue();
					 
			         $group = $objPHPExcel->getActiveSheet()->getCell("D" .$i)->getValue();
			         
			         $data['workingPlace'] = $objPHPExcel->getActiveSheet()->getCell("E" .$i)->getValue();
			         $data['height'] = $objPHPExcel->getActiveSheet()->getCell("F" .$i)->getValue();
			         $data['weight'] = $objPHPExcel->getActiveSheet()->getCell("G" .$i)->getValue();
			         $data['birthday'] = $objPHPExcel->getActiveSheet()->getCell("H" .$i)->getValue();
			         $data['position'] = $objPHPExcel->getActiveSheet()->getCell("I" .$i)->getValue();
			         $data['medicalHistory'] = $objPHPExcel->getActiveSheet()->getCell("J" .$i)->getValue();
			         $data['ctime'] = date('Y-m-d H:i:s');
			         $data['email'] = $objPHPExcel->getActiveSheet()->getCell("K" .$i)->getValue();
			         $student_number = $objPHPExcel->getActiveSheet()->getCell("L" .$i)->getValue();
			         $data['status'] = 1;
			         $password = 123456;
			         $data['password'] = md5($password);
			         $data['jl_id']=$_SESSION['id'];
			         $is_exit = M("organization")->where("name = '$group'")->find();
			       /* if(preg_match("/^1[34578]{1}\d{9}$/",$tel)){  
					    $mobile = $tel; 
					}else{  
						$name = $data['nickname'];
						echo "<input type='hidden' value='{$name}' id='".$i."'>";
					    echo "<script>  var name =  document.getElementById('".$i."').value; var str = name+'手机号格式不正确'; alert(str);</script>";
					} */
				//	echo $i;
					$student_numbers = M("user")->where("student_number = '$student_number'")->getfield("student_number");
			                                        if (empty($student_number) && empty($group)) {
						continue;
                                        }					
//print_r($student_numbers);exit("学号");
					if (! ($student_number && $group)) {
						// echo $student_number .$group;
						// echo '13';
						 $this->error("姓名，用户组必填");die();
					}elseif($student_numbers){
 						$name = $data['nickname'];
						echo "<input type='hidden' value='{$name}' id='".$i."'>";
					    echo "<script>  var name =  document.getElementById('".$i."').value; var str = name+'学号与别人重复'; alert(str);</script>";
					}else{
						$data['student_number'] =$prx['kouling']. $student_number;
						if ($is_exit ) {
				        	$data['groups'] = $group;
				            $bool = M('user')->add($data);
				         }else{
				            $name = $data['nickname'];
							echo "<input type='hidden' value='{$name}' id='".$i."'>";
						    echo "<script>  var name =  document.getElementById('".$i."').value; var str = name+'组织不存在'; alert(str);</script>";
				         }
					}
				}
                if($bool != NULL){
                    $this->success('导入成功!');
                } else {
                    $this->error("请选择上传的文件");
                }  
		}
	}
}	
