<?php
	include_once("system.inc.php");
	$id=$_GET["id"];
	$table=$_GET["table"];
	$status=$_GET["status"];
	if($status == 0)
		$status=1;
	else
		$status=0;
	$sql="UPDATE $table SET $table"."Status"."='$status' WHERE Id='$id'";
//	echo $sql;
	$result=$admindb->RunSQL($conn,$sql);
	echo $result;
	$connobj->CloseCon();
?>