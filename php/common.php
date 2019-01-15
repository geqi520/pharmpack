<?php
require_once("system.inc.php");
/* 
 *返回搜索的sql语句
 *@param string $table 要查的表
 *@param object $obj  要查的字段数据
 *return string
 */
function sql_search($table, $obj) {
	if(!is_object($obj) || !is_exist_table($table)) return false;
	$sql = "SELECT * FROM " . $table . " WHERE ";
	foreach($obj as $key => $value) {
		if(!empty($value))
			$sql = $sql . $key . "=" . "'$value'" . " AND ";
	}
	return substr($sql,0,strlen($sql)-5);
}

/* 表是否存在
   @param string $table 表名
   return  bool
 */
function is_exist_table($table) {
	global $conn;
	$result = sqlsrv_query($conn,"select Name from sysobjects where xtype='U' ORDER BY Name");
	while($row=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
		if($row['Name'] == $table) {
			return true;
		}
	}
	return false;
}

