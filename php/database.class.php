<?php
//连接数据库
class ConnDB{
//	public $dbtype;
	public $host;
	public $user;
	public $pwd;
	public $dbname;
	public $conn;
	//构造函数赋值
	function ConnDB($host,$user,$pwd,$dbname){
//		$this->dbtype=$dbtype;
		$this->host=$host;
		$this->user=$user;
		$this->pwd=$pwd;
		$this->dbname=$dbname;
	}
	//得到连接数据库的连接
	function GetConn(){
		$connectionInfo=array("Database"=>$this->dbname,"UID"=>$this->user,"PWD"=>$this->pwd);
		$this->conn=sqlsrv_connect($this->host,$connectionInfo);
		return $this->conn;
	}
	//关闭数据库连接
	function CloseCon(){
		sqlsrv_close($this->conn);
	}
}

//操作数据库
class AdminDB{
	function RunSQL($conn,$sql){
		$sqltype=strtolower(substr(trim($sql),0,6));
		$result=sqlsrv_query($conn,$sql);
		try{
			if($sqltype == "select"){
				if($result==false){
					//throw new exception("select error",1);
					return false;
				}
				else{
					$array=array();
					while($row=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
					{
						$array[]=$row;
					}
					return $array;
				}
					
			}
			elseif($sqltype=="update"||$sqltype=="insert"||$sqltype=="delete"){
				if($result)
					return true;
				else
					throw new exception("change error",2);
					return false;
			}
		}catch(exception $e){
			echo "position:".$e->getcode()."  msg:".$e->getMessage();
		}
	}
}
