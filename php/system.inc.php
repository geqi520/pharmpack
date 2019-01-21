<?php
session_start();
	header('Content-type:text/html;charset=UTF-8');
	require_once("database.class.php");
	if(empty($_SESSION['admin'])) {
		echo "<script>";
		echo "alert('请登录');";
		echo "window.location.href = '../index.html';";
		echo "</script>";
	}
	/* 
	*在ConnDB创建时，依次填入  数据库服务器名称（地址），用户名，密码，数据库名
	*$connobj是连接业务处理的数据库名
	*$connobjCode 是连接存放药监码的数据库名 
	*/
	$connobj= new ConnDB("NPA25G8GSPJ9VBP\SQLFIRST","admin","123456","ph1");
	$conn=$connobj->GetConn();
	$connobjCode= new ConnDB("NPA25G8GSPJ9VBP\SQLFIRST","admin","123456","ph2");
	$connCode=$connobjCode->GetConn();
	$admindb=new AdminDB;
	if(!$conn){
		echo "connction error!";
		die(print_r(sqlsrv_errors(),true));
	}
	
?>