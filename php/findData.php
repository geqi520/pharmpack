<?php
	include_once("system.inc.php");
	$first=$_GET["page"]*$_GET["limit"];
	$secend=($_GET["page"]-1)*$_GET["limit"];
	$table=$_GET["table"];
	switch($table){
		case 'PackingLine':
			$sql="SELECT TOP $first Id,IndustrialComputerId AS IPC,Code,Name,Manager,WorkShop,Status,Remark1 FROM PackingLine WHERE Id not in (SELECT TOP $secend Id FROM PackingLine)";
			break;
		case 'PackingRule':
			$sql="SELECT TOP $first Id,Code,Name,GTIN,Level,PkgRatio AS Ratio,Status FROM PackingRule WHERE Id not in (SELECT TOP $secend Id FROM PackingRule)";
			break;
		case 'Enterprise':
			$sql="SELECT TOP $first Id,Code,Name,Status,Creator FROM Enterprise WHERE Id not in (SELECT TOP $secend Id FROM Enterprise)";
			break;
		case 'IndustrialComputer':
			$sql="SELECT TOP $first Id,Code,Name,Status FROM IndustrialComputer WHERE Id not in (SELECT TOP $secend Id FROM IndustrialComputer)";
			break;
		case 'ProductEntity':
			$sql="SELECT TOP $first Id,Code,Name,GTIN,AuthorizedNo,Spec,PackUnit,Status FROM ProductEntity WHERE Id not in (SELECT TOP $secend Id FROM ProductEntity)";
			break;
		default:
			return 0;
	}
	$row=$admindb->RunSQL($conn,$sql);
	$arr=[
		"code"   => "0",
		"msg"    => "",
		"count"  => "",
		"data"   => "",
	];
	$arr["count"]=count($admindb->RunSQL($conn,"SELECT Id FROM $table"));
	$arr["data"]=$row;
	echo json_encode($arr);
	$connobj->CloseCon();
?>