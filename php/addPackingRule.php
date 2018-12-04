<?php
	include_once("system.inc.php");
	$data=json_decode($_POST["data"]);
	$ratio;
	switch($data->level){
		case 1:
			$ratio="$data->ratio0";
			break;
		case 2:
			$ratio="$data->ratio0:$data->ratio1";
			break;
		case 3:
			$ratio="$data->ratio0:$data->ratio1:$data->ratio2";
			break;
		case 4:
			$ratio="$data->ratio0:$data->ratio1:$data->ratio2:$data->ratio3";
			break;
	}
	$sql="INSERT INTO PackingRule (Code,Name,GTIN,Level,Ratio) VALUES ('$data->code','$data->rulename','$data->GTIN','$data->level','$ratio')";
	$result=$admindb->RunSQL($conn,$sql);
	echo $result;
?>