<?php
	$serverName="NPA25G8GSPJ9VBP\SQLFIRST";
	$connectionInfo=array("Database"=>"Manage","UID"=>"admin","PWD"=>"123456");
	$conn=sqlsrv_connect($serverName,$connectionInfo);
	$username=$_POST["username"];
	$password=$_POST["password"];
	if(!$conn){
		echo "error";
		die(print_r(sqlsrv_errors(),true));
	}
	$sql="SELECT * FROM UserTable WHERE username='$username' and password='$password'";
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
		echo "<script>";
		echo "window.location.href='../html';";
		echo "</script>";
	}
	sqlsrv_free_stmt($result);
	sqlsrv_close($conn);
?>