<?php
	include_once("system.inc.php");
	$data=json_decode($_POST["data"]);
	$sql="UPDATE PackingLine SET IPC='$data->IPC',Code='$data->code',Name='$data->packname',Manager='$data->manager',WorkShop='$data->workshop',Remark='$data->remark' WHERE Id='$data->id'";
	$result=$admindb->RunSQL($conn,$sql);
	echo $result;
		
?>