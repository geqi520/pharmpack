<?php
require_once("system.inc.php");
$first=$_GET["page"]*$_GET["limit"];
$secend=($_GET["page"]-1)*$_GET["limit"];
$action = !empty($_GET['action']) ? json_decode($_GET['action']) : null;
// echo $sql;
$arr=[
	"code"   => "0",
	"msg"    => "",
	"count"  => "",
	"data"   => null,
];
if(!empty($action)){
	$sql1 = "SELECT ROW_NUMBER() over(order by CodeHashValue) AS rowNumber,Code,NextCode,LevelNo,CodeStatus,PrintBatchNo,TaskID,ProductID FROM CodeEntity WHERE ";
	foreach($action as $key => $value) {
		if(!empty($value))
			$sql1 = $sql1 . $key . "=" . "'$value'" . " AND ";
	}
	$sql1 = substr($sql1,0,strlen($sql1)-5);
	$sql = "SELECT * FROM (" . $sql1 . ") AS newTb WHERE rowNumber between $secend and $first";
	// echo $sql1 . "</br>";
	// echo $sql . "</br>";
	$row=$admindb->RunSQL($connCode,$sql);
	$arr["count"]=count($admindb->RunSQL($connCode,$sql1));
	$arr["data"]=$row;
	// print_r("<pre>");
	// print_r($row);
	// print_r($arr);
	// print_r("</pre>");
	$connobj->CloseCon();
	// var_dump(json_last_error());
}
echo json_encode($arr);