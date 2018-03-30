<?php
	/**
	 * 取得二维码图片
	**/
	include './phpqrcode/phpqrcode.php';
	$id = $_GET['r_id'];
	$user_id = $_GET['user_id'];
	if(!($id && $user_id)){
			echo '{"succeed": "1", "message": "缺少参数"}';
			exit;
				echo '123';die;
	}
	$value = "http://www.acdov.cn/heartwaves/index.php?m=Home&c=apiuserr&a=getline&user_id=".$user_id."&rid=".$id; //二维码内容
	$errorCorrectionLevel = 'L';//容错级别
	$matrixPointSize = 6;//生成图片大小
	//生成二维码图片
	QRcode::png($value, './'.$id.time().'.png', $errorCorrectionLevel, $matrixPointSize, 2);   
	$QR = './'.$id.time().'.png';//已经生成的原始二维码图
	//获得背景图片
	echo "<!DOCTYPE html>
			<html lang='en'>
			<head>
				<meta charset='UTF-8'>
				<title>二维码</title>
				<script type='text/javascript' src='http://www.acdov.cn/heartwaves/Public/js/jquery-2.1.1.js'></script>
			</head>
			<body>
			<div style='text-align:center;'><img src='http://www.acdov.cn/heartwaves/hahaha/".$id.time().".png'></div>
			</body>
			</html>";
	
	?>