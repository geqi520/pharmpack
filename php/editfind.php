<?php
	require_once("system.inc.php");
	$row=$admindb->RunSQL($conn,"SELECT Id,Name FROM Enterprise");
	$row["count"]=count($row);
	echo json_encode($row);
	$connobj->CloseCon();
?>