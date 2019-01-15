<?php
	require_once("system.inc.php");
	$id=$_GET["id"];
	$table=$_GET["table"];
	$sql="DELETE FROM $table WHERE Id='$id'";
	$result=$admindb->RunSQL($conn,$sql);
	echo $result;
	$connobj->CloseCon();
?>