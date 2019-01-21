<?php
session_start();
	$serverName="NPA25G8GSPJ9VBP\SQLFIRST";				//sql server数据库服务器名称（地址）
	$connectionInfo=array("Database"=>"ph1","UID"=>"admin","PWD"=>"123456");	//数据库名，用户名，密码
	$conn=sqlsrv_connect($serverName,$connectionInfo);
	$username=$_POST["username"];
	$password=md5($_POST["password"]);
	if(!$conn){
		echo "error";
		die(print_r(sqlsrv_errors(),true));
	}
	$sql="SELECT * FROM Account WHERE LoginName='$username' and Password='$password' and AccountStatus = 1";
	$result=sqlsrv_query($conn,$sql);
	if($result===false){
		echo "error";
		die(print_r(sqlsrv_errors(),true));
	}
	$row=sqlsrv_has_rows($result);
	if(!$row){
		echo "<script>";
		echo "alert('用户或密码错误');";
		echo "window.location.href='../index.html';";
		echo "</script>";
	}
	else{
		$data = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
		$admin = [
			'id'	=>	$data['Id'],
			'name'	=>	$data['TrueName']
		];
		$_SESSION['admin'] = $admin;
		echo "<script>";
		echo "window.location.href='../html';";
		echo "</script>";
	}
	sqlsrv_free_stmt($result);
	sqlsrv_close($conn);
?>