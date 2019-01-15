<?php
	require_once("system.inc.php");
	$first=$_GET["limit"];
	$secend=($_GET["page"]-1)*$_GET["limit"];
	$table=$_GET["table"];
	$array=array();
	$sql="SELECT TOP $first * FROM SystemLog WHERE Id not in (SELECT TOP $secend Id FROM SystemLog)";
//	echo $sql;
	$result=sqlsrv_query($conn,$sql);
	while($row=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
	{	
		$row["ModulesName"]=iconv('GBK','UTF-8',$row["ModulesName"]);
		$row["ActionName"]=iconv('GBK','UTF-8',$row["ActionName"]);
		$row["Message"]=iconv('GBK','UTF-8',$row["Message"]);
		$row["Operator"]=iconv('GBK','UTF-8',$row["Operator"]);
		$row["OperateTime"]=$row["OperateTime"]->format('Y-m-d H:i:s');
		$array[]=$row;
	}
	$arr=[
		"code"   => "0",
		"msg"    => "",
		"count"  => "",
		"data"   => $array,
	];
	$arr["count"]=count($admindb->RunSQL($conn,"SELECT Id FROM $table"));
	 // print_r("<pre>");
	 // print_r($row);
	 // print_r($arr);
	 // print_r("</pre>");
	echo json_encode($arr);
?>