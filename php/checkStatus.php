<?php
session_start();
if(isset($_SESSION['admin'])) {
	$result['type']	= true;
	$result['msg']	= '登录成功';
	$result['name']	= $_SESSION['admin']['name'];
}else {
	$result['type']	= false;
	$result['msg']	= '请登录';
}
echo json_encode($result);