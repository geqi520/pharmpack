<?php
	include_once("system.inc.php");
	$table=$_POST["table"];
	$data=json_decode($_POST["data"]);
	switch($table){
		case 'PackingLine':
			$sql="INSERT INTO PackingLine (IndustrialComputerId,Code,Name,Manager,WorkShop,Remark1) VALUES ('$data->IPC','$data->code','$data->packname','$data->manager','$data->workshop','$data->remark')";
			break;
		case 'PackingRule':
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
			$sql="INSERT INTO PackingRule (Code,Name,GTIN,Level,PkgRatio) VALUES ('$data->code','$data->rulename','$data->GTIN','$data->level','$ratio')";
			break;
		case 'Enterprise':
			$sql="INSERT INTO Enterprise (Code,Name,Creator) VALUES ('$data->code','$data->name','$data->creator')";
			break;
		case 'IndustrialComputer':
			$sql="INSERT INTO IndustrialComputer (Code,Name,Remark1) VALUES ('$data->code','$data->name','$data->remark')";
			break;
		default:
			return 0;
	}
	$result=$admindb->RunSQL($conn,$sql);
	echo $result;
?>