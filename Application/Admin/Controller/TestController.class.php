<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/24
 * Time: 15:24
 */
namespace Admin\Controller;
use Think\Controller;
header("content-type:text/html;charset=utf-8");
include './function.php';
$link=connect();
require 'PHPExcel.php';
require 'PHPExcel/IOFactory.php';
require 'PHPExcel/Reader/Excel5.php';
$objReader = PHPExcel_IOFactory::createReader('excel2007'); //use Excel5 for 2003 format
//var_dump($objReader);die;
$excelpath=$_POST['file'];
//var_dump($name);die;
//$excelpath='Book3.xlsx';
$objPHPExcel = $objReader->load($excelpath);
$sheet = $objPHPExcel->getSheet(0);
$highestRow = $sheet->getHighestRow();           //取得总行数
$highestColumn = $sheet->getHighestColumn(); //取得总列数
//var_dump($highestRow);die;
for($j=2;$j<=$highestRow;$j++)                        //从第二行开始读取数据
{
    $str="";
    for($k='A';$k<=$highestColumn;$k++)            //从A列读取数据
    {
        $str.=$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().'|*|';//读取单元格
    }
    $str=mb_convert_encoding($str,'utf8','auto');//根据自己编码修改
    //var_dump($str);die;
    $str1=rtrim($str,"|*|");
    //var_dump($str1);die;
    $strs = explode("|*|",trim($str1));
/*echo $str . "<br />";
exit;*/
//var_dump($strs[0]);die;
    $title=$strs[0];
    $content=$strs[1];
    $sn=$strs[2];
    $num=$strs[3];
    /*$sql="insert into test('title','content','sn','num') values('{$title}','{$content}','{$sn}','{$num}')";*/
    $sql="insert into test(title,content,sn,num) values('$title','$content','$sn','$num')";
    $result=mysqli_query($link,$sql);
    //$row=mysqli_affected_rows($result);
    var_dump($result);die;
    if($result)
    {
        echo 'excel success';
    }else{
        echo 'err';
    }

}

