<?php
require_once("system.inc.php");
$data=json_decode($_POST["data"]);
$Account = $admindb->RunSQL($conn,"SELECT Id FROM Account WHERE TrueName = '$data->truename' AND LoginName = '$data->loginname'");
if($Account || $Account != null){
	$result["type"] = false;
	$result["msg"] = "用户已存在";
	echo json_encode($result);
	return 0;
}
$sql="INSERT INTO Account (TrueName,LoginName,Password,Creator) VALUES ('$data->truename','$data->loginname','".md5($data->password)."','root')";
$result_acc=$admindb->RunSQL($conn,$sql);
if(!$result_acc) {
	$result["type"] = false;
	$result["msg"] = "添加失败";
	echo json_encode($result);
	return 0;
}
$AccountID = $admindb->RunSQL($conn,"SELECT Id FROM Account WHERE TrueName = '$data->truename'");
// var_dump($AccountID[0]["Id"]);
// $sql1 = "INSERT INTO AccountRole (AccountID,RoleID) VALUES ('" . $AccountID[0]['Id'] . "','$data->RoleID')";
// echo $sql1;
$result2 = $admindb->RunSQL($conn,"INSERT INTO AccountRole (AccountID,RoleID) VALUES ('" . $AccountID[0]['Id'] . "','$data->RoleID')");
// var_dump($result2);
if(!$result2) {
	$admindb->RunSQL($conn,"DELETE FROM Account WHERE TrueName = '$data->truename'");
	$result["type"] = false;
	$result["msg"] = "添加失败";
	echo json_encode($result);
	return 0;
}
$result["type"] = true;
$result["msg"] = "添加成功";
echo json_encode($result);