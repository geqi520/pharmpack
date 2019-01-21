<?php
	require_once("system.inc.php");
	$table = $_GET['table'];
	if($table == "TaskEntity") {
		$sql = "SELECT Id,Code FROM $table";
	}else {
		$sql = "SELECT Id,Name FROM $table";
	}
	$row=$admindb->RunSQL($conn,$sql);
	$row["count"]=count($row);
	echo json_encode($row);
	$connobj->CloseCon();
