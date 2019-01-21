<?php
require_once("system.inc.php");
$data=json_decode($_POST["data"]);
$admin = $_SESSION['admin'];
$Account = $admindb->RunSQL($conn,"SELECT Id FROM Account WHERE Id='".$admin['id']."' AND Password = '".md5($data->old_password)."'");
//var_dump($Account);
if($Account == null){
	$result["type"] = false;
	$result["msg"] = "原密码错误";
	echo json_encode($result);
	return 0;
}
$sql="UPDATE Account SET Password='".md5($data->password)."' WHERE Id='".$admin['id']."'";
// echo $sql;
$result_acc=$admindb->RunSQL($conn,$sql);
if(!$result_acc) {
	$result["type"] = false;
	$result["msg"] = "修改失败";
	echo json_encode($result);
	return 0;
}
$result["type"] = true;
$result["msg"] = "修改成功";
echo json_encode($result);
return 0;
