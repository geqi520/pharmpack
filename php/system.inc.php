<?php
	header('Content-type:text/html;charset=UTF-8');
	require("database.class.php");
	$connobj= new ConnDB("NPA25G8GSPJ9VBP\SQLFIRST","admin","123456","Manage");
	$conn=$connobj->GetConn();
	$admindb=new AdminDB;
	if(!$conn){
		echo "connction error!";
		die(print_r(sqlsrv_errors(),true));
	}
?>