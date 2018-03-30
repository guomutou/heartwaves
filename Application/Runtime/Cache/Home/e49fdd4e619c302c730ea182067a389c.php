<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script type="text/javascript" src="/heartwaves/Public/js/jquery.rotate.min.js"></script>
	<script type="text/javascript" src="/heartwaves/Public/js/jquery.min.js"></script>
	<script type="text/javascript" src="/heartwaves/Public/js/jquery-1.7.1.min.js"></script>
</head>
<body>
	<img src="/heartwaves/Public/img/45345.png" id="coujiang">
</body>
</html>
<script type="text/javascript">
	$("#coujiang").rotate({
		angle:ob,
		animateTo:ob,
		duration:1000,
		callback:function(){
		}
	});
</script>