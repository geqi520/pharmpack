<?php
	include_once("system.inc.php");
	$first=$_GET["page"]*$_GET["limit"];
	$secend=($_GET["page"]-1)*$_GET["limit"];
	$sql="SELECT TOP $first Id,IPC,Code,Name,Manager,WorkShop,Status,Remark FROM PackingLine WHERE Id not in (SELECT TOP $secend Id FROM PackingLine)";
	$row=$admindb->RunSQL($conn,$sql);
	$arr=[
		"code"   => "0",
		"msg"    => "",
		"count"  => "",
		"data"   => "",
	];
	$arr["count"]=count($admindb->RunSQL($conn,"SELECT Id FROM PackingLine"));
	$arr["data"]=$row;
	echo json_encode($arr);
	$connobj->CloseCon();
?>