<?php
require_once("common.php");
$table = !empty($_GET['table']) ? $_GET['table'] : null;
$data = !empty($_GET['data']) ? json_decode($_GET["data"]) : null;
if(empty($table) || empty($data)) return false;
if($table == "TaskEntity") {
	$sql = "SELECT a.Id,a.Code,a.Status,a.TeamNo,a.Plant,a.LOT,b.Name as PackingLine,c.PkgRatio,d.Name,d.Spec FROM TaskEntity a,PackingLine b,PackingRule c,ProductEntity d WHERE ";
	foreach($data as $key => $value) {
		if(!empty($value))
			$sql = $sql . $key . "=" . "'$value'" . " AND ";
	}
	$sql = $sql . "a.PackingLineId=b.Id and a.PackingRuleId=c.Id and a.ProductId=d.Id";
}else {
	$sql = sql_search($table,$data);
}
//echo $sql;
$row = $admindb->RunSQL($conn,$sql);
$arr = [
	"code"   => "0",
	"msg"    => "",
	"count"  => count($admindb->RunSQL($conn,$sql)),
	"data"   => $row,
];
$connobj->CloseCon();
echo json_encode($arr);
