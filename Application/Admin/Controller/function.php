<?php
/*
*author zsl;
*date:2016年7月20日
*/
header("content-type:text/html;charset=utf-8");

function connect(){
	include 'config.php';
	$link=@mysqli_connect($config['host'],$config['user'],$config['pwd'], $config['dbName'])or die('error:'.mysqli_connect_errno());
	mysqli_set_charset($link,$config['code']);
	return $link;
}

function read($sql){
	$link=connect();
	$result=@mysqli_query($link, $sql) or die('error:');
	while($row=mysqli_fetch_assoc($result)){
		$rows[]=$row;
	}
	return $rows;
}

function del($sql){
	$link=connect();
	$result=@mysqli_query($link, $sql) or die('error:');
	if($result && mysqli_affected_rows($link)){
		return 1;
	}else{
		return 0;
	}
}

function add($sql){
	$link=connect();
	$result=@mysqli_query($link, $sql) or die('statement error:'.mysqli_errno($link));
	if($result && mysqli_insert_id($link)){
		return 1;
	}else{
		return 0;
	}
}

function executeSql($sql){
	$link=connect();
	$result=@mysqli_query($link, $sql) or exit("mysql error:".mysqli_error($link));
	if($result && mysqli_affected_rows($link)>0){
		return true;//return 1;
	}else{
		return false;
	}
}
