<?php
require_once("DataAccess.class.php");
class Authentication
{
	public $uname_field,$password_field,$utype_field,$table;
	public $dao,$table,$utype,$status,$error;
	private $encryption;

	public function __construct()
	{
		$this->dao = new DataAccess();
		$this->uname_field="log_uname";
		$this->password_field="log_password";
		$this->utype_field="log_utype";
		$this->encryption=false;
		$this->table="login";
		$this->error="";
	}
	public function authenticate($uname,$password)
	{
		if($row=$this->dao->getDataRow("*",$this->table,$this->uname_field."='$uname'"))
		{
			if($this->encryption){ $password =md5($password);}
			if($row[$this->password_field] == $password)
			{
				$this->utype=$row[$this->utype_field];
				return true;
			}
			else
			{
				$this->error="Invalid Username Or Password";
				return false;
			}
			 
		}
		else
		{
			$this->error="Invalid Username Or Password";
			return false;
		}
	}


}
