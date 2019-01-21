<?php
	require_once("system.inc.php");
	$first=$_GET["page"]*$_GET["limit"];
	$secend=($_GET["page"]-1)*$_GET["limit"];
	$table=$_GET["table"];
	switch($table){
		case 'PackingLine':
			$sql="SELECT TOP $first Id,IndustrialComputerId AS IPC,Code,Name,Manager,WorkShop,PackingLineStatus as Status,Remark1 FROM PackingLine WHERE Id not in (SELECT TOP $secend Id FROM PackingLine)";
			break;
		case 'PackingRule':
			$sql="SELECT TOP $first Id,Code,Name,GTIN,Level,PkgRatio AS Ratio,PackingRuleStatus AS Status FROM PackingRule WHERE Id not in (SELECT TOP $secend Id FROM PackingRule)";
			break;
		case 'Enterprise':
			$sql="SELECT TOP $first Id,Code,Name,EnterpriseStatus AS Status,Creator FROM Enterprise WHERE Id not in (SELECT TOP $secend Id FROM Enterprise)";
			break;
		case 'IndustrialComputer':
			$sql="SELECT TOP $first Id,Code,Name,IndustrialComputerStatus AS Status FROM IndustrialComputer WHERE Id not in (SELECT TOP $secend Id FROM IndustrialComputer)";
			break;
		case 'ProductEntity':
			$sql="SELECT TOP $first *,ProductEntityStatus as Status FROM ProductEntity WHERE Id not in (SELECT TOP $secend Id FROM ProductEntity)";
			break;
		case 'Account':
			$sql="SELECT TOP $first a.*,c.Name from Account a,AccountRole b,Role c where a.Id=b.AccountID and b.RoleID=c.Id and a.Id not in (SELECT TOP $secend Id FROM Account)";
			break;
		case 'BatchReport':
			$sql="SELECT TOP $first Level,GTIN,Pending,Accepted,Rejected,Discarded,UnAggregated,Sample,Total from BatchReport WHERE Id not in (SELECT TOP $secend Id FROM BatchReport)";
			break;
		case 'TaskEntity':
			$sql="SELECT TOP $first a.Id,a.Code,a.Status,a.TeamNo,a.Plant,a.LOT,b.Name as PackingLine,c.PkgRatio,d.Name,d.Spec FROM TaskEntity a,PackingLine b,PackingRule c,ProductEntity d WHERE a.PackingLineId=b.Id and a.PackingRuleId=c.Id and a.ProductId=d.Id and a.Id not in (SELECT TOP $secend Id FROM TaskEntity)";
			break;
		default:
			return 0;
	}
	// echo $sql;
	$row=$admindb->RunSQL($conn,$sql);
	$arr=[
		"code"   => "0",
		"msg"    => "",
		"count"  => "",
		"data"   => "",
	];
	$arr["count"]=count($admindb->RunSQL($conn,"SELECT Id FROM $table"));
	$arr["data"]=$row;
	// print_r("<pre>");
	// print_r($row);
	// print_r($arr);
	// print_r("</pre>");
	echo json_encode($arr);
//	var_dump(json_last_error());
	$connobj->CloseCon();
?>