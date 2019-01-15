<?php
require_once("common.php");
$table = !empty($_GET['table']) ? $_GET['table'] : null;
$data = !empty($_GET['data']) ? json_decode($_GET["data"]) : null;
$sql = sql_search($table,$data);
$row = $admindb->RunSQL($conn,$sql);
$arr = [
	"code"   => "0",
	"msg"    => "",
	"count"  => count($admindb->RunSQL($conn,$sql)),
	"data"   => $row,
];
$connobj->CloseCon();
echo json_encode($arr);
