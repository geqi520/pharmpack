<?php
	include_once("system.inc.php");
	$table=$_POST["table"];
	$data=json_decode($_POST["data"]);
	switch ($table){
		case 'PackingLine':
			$sql="UPDATE PackingLine SET IndustrialComputerId='$data->IPC',Code='$data->code',Name='$data->packname',Manager='$data->manager',WorkShop='$data->workshop',Remark1='$data->remark' WHERE Id='$data->id'";
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
			$sql="UPDATE PackingRule SET Code='$data->code',Name='$data->rulename',GTIN='$data->GTIN',Level='$data->level',PkgRatio='$ratio' WHERE Id='$data->id'";
			break;
		case 'Enterprise':
			$sql="UPDATE Enterprise SET Code='$data->code',Name='$data->name',Creator='$data->creator' WHERE Id='$data->id'";
			break;
		case 'IndustrialComputer':
			$sql="UPDATE IndustrialComputer SET Code='$data->code',Name='$data->name',Remark1='$data->remark' WHERE Id='$data->id'";
			break;
		case 'ProductEntity':
			$sql="UPDATE ProductEntity SET Code='$data->code',Name='$data->name',GTIN='$data->GTIN',AuthorizedNo='$data->AuthorizedNo',EnterpriseID='$data->modules',ValidTime='$data->exp',Spec='$data->spec',FormOfDrug='$data->NDC',PackUnit='$data->packunit',Remark2='$data->pack',Creator='$data->creator',CreateDate='$data->createdate' WHERE Id='$data->id'";
			break;
		case 'Account':
			$sql="UPDATE Account SET TrueName='$data->truename',LoginName='$data->loginname',Password='$data->password' WHERE Id='$data->id'";
			break;
		default:
			return 0;
	}
	$result=$admindb->RunSQL($conn,$sql);
	echo $result;
?>