<?php
	include_once("system.inc.php");
	$data=json_decode($_POST["data"]);
	$sql="INSERT INTO PackingLine (IPC,Code,Name,Manager,WorkShop,Remark) VALUES ('$data->IPC','$data->code','$data->packname','$data->manager','$data->workshop','$data->remark')";
	$result=$admindb->RunSQL($conn,$sql);
	echo $result;
?>