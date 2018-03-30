<?php
namespace Admin\Controller;
use Think\Controller;
class OnlineUpdateController extends CommonController
{
            public function index(){
                        $m   = M("email_set");
                        $arr = $m->where("id= 1")->find();
                        $this->assign("arr", $arr);
                        $m     = M("email_type");
                        $email = $m->find(1);
                        $this->assign("email", $email);
                        $this->display();
            }

            public function down_zip(){
                        $this->display("1");
                        echo "<script>zhuijia('升级准备中...',10)</script>";
                        // 文件下载地址
                        $url                = $_GET['url'];
                        //文件名
                        $filename           = $_GET['name'];
                        // 文件夹名字
                        $dirName = $_GET['dirname'];
                        //创建保存目录
                        $destination_folder = "./OnlineUpdate/";
                        echo "<script>zhuijia('开始下载文件...',30)</script>";
                        if (!is_dir($destination_folder))
                                    mkdir($destination_folder, 0777);
                        $file = fopen($url, "rb");
                        if ($file) {
                                    $newfname = $destination_folder . basename($url);
                                    $newf     = fopen($newfname, "wb");
                                    $downlen  = 0;
                                    if ($newf) {
                                                while (!feof($file)) {
                                                            $data = fread($file, 1024 * 8); //默认获取8K
                                                            $downlen += strlen($data); // 累计已经下载的字节数
                                                            fwrite($newf, $data, 1024 * 8);
                                                }
                                                if ($file) fclose($file);
                                                if ($newf) fclose($newf);
                                                echo "<script>zhuijia('开始解压文件...',60)</script>";
                                                $this->get_zip_originalsize("./OnlineUpdate/" . $filename, "./");
                                                echo "<script>zhuijia('文件升级完毕...',65)</script>";
                                                echo "<script>zhuijia('开始整理数据库文件...',70)</script>";
                                                $file = file_get_contents("./OnlineUpdate/{$dirName}/sql.sql");
                                                echo "<script>zhuijia('开始执行SQL语句...',80)</script>";
                                                $m = M();
                                                $result = $m->execute($file);
                                                if($result>0){
                                                    echo "<script>zhuijia('SQL语句执行成功...',90)</script>";
                                                }else{
                                                    echo "<script>zhuijia('SQL语句执行失败...',100)</script>";
                                                    exit();
                                                }
                                                echo "<script>zhuijia('网站成功升级完毕...',100)</script>";
                                                echo "<script>zhuijia('关闭此页面重新打开网站即可',100)</script>";
                                    }
                        }
            }

            public function get_zip_originalsize($filename, $path){
                        header("Content-type:text/html;charset=utf-8");
                        //先判断待解压的文件是否存在
                        if (!file_exists($filename)) {
                                    die("文件 $filename 不存在！");
                        }
                        //将文件名和路径转成windows系统默认的gb2312编码，否则将会读取不到
                        $filename = iconv("utf-8", "gb2312", $filename);
                        $path     = iconv("utf-8", "gb2312", $path);
                        //打开压缩包
                        $resource = zip_open($filename);
                        $i        = 1;
                        //遍历读取压缩包里面的一个个文件
                        while ($dir_resource = zip_read($resource)) {
                                    //如果能打开则继续
                                    if (zip_entry_open($resource, $dir_resource)) {
                                                //获取当前项目的名称,即压缩包里面当前对应的文件名
                                                $file_name = $path . zip_entry_name($dir_resource);
                                                //以最后一个“/”分割,再用字符串截取出路径部分
                                                $file_path = substr($file_name, 0, strrpos($file_name, "/"));
                                                //如果路径不存在，则创建一个目录，true表示可以创建多级目录
                                                if (!is_dir($file_path)) {
                                                            mkdir($file_path, 0777, true);
                                                }
                                                //如果不是目录，则写入文件
                                                if (!is_dir($file_name)) {
                                                            //读取这个文件
                                                            $file_size = zip_entry_filesize($dir_resource);
                                                            //最大读取100M，如果文件过大，跳过解压，继续下一个
                                                            if ($file_size < (1024 * 1024 * 100)) {
                                                                        $file_content = zip_entry_read($dir_resource, $file_size);
                                                                        file_put_contents($file_name, $file_content);
                                                            } else {
                                                                        echo "<script>zhuijia('文件过大...',100)</script>";
                                                                        echo "<script>zhuijia('升级失败...',100)</script>";
                                                                        exit();
                                                            }
                                                }
                                                //关闭当前
                                                zip_entry_close($dir_resource);
                                    }
                        }
                        //关闭压缩包
                        zip_close($resource);
            }


}
