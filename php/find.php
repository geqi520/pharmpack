<?php
	// $serverName="NPA25G8GSPJ9VBP\SQLFIRST";
	// $connectionInfo=array("Database"=>"yaojianma","UID"=>"admin","PWD"=>"123456");
	// $conn=sqlsrv_connect($serverName,$connectionInfo);
	include_once("system.inc.php");
	$productId=$_GET["id"];
	$ma_type=$_GET["tp"];
	if(!$conn){
		echo "error";
		die(print_r(sqlsrv_errors(),true));
	}
		switch($ma_type){
			case 'Bottle':
				$Id="BottleId";
				break;
			case 'SmallBox':
				$Id="SmallBoxId";
				break;
			case 'MiddleBox':
				$Id="MiddleBoxId";
				break;
		}

		$sql="SELECT * FROM $ma_type WHERE $Id='$productId'";
		$row=$admindb->ExecSQL($conn,$sql);
		echo "<table>";
		echo "<tr><td>产品ID</td><td>下一级码的ID号</td></tr>";
		echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td></tr>";
		echo "</table>";
		sqlsrv_close($conn);
?>