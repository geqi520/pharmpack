<?php
	include_once("system.inc.php");
	$first=$_GET["page"]*$_GET["limit"];
	$secend=($_GET["page"]-1)*$_GET["limit"];
	$sql="SELECT TOP $first Id,Code,Name,GTIN,Level,Ratio,Status FROM PackingRule WHERE Id not in (SELECT TOP $secend Id FROM PackingRule)";
	$row=$admindb->RunSQL($conn,$sql);
	$arr=[
		"code"   => "0",
		"msg"    => "",
		"count"  => "",
		"data"   => "",
	];
	$arr["count"]=count($admindb->RunSQL($conn,"SELECT Id FROM PackingRule"));
	$arr["data"]=$row;
	echo json_encode($arr);
	$connobj->CloseCon();
?>