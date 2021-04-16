<?php

class DataAccess
{
	private $_con,$_q;

	public function __construct()
	{
		if(!$this->_con=mysqli_connect("localhost","root","","chacko"))
		{
			die("Connection Failure");
		}
	}

	public function insertFull($data,$table)
	{
		if(is_array($data))
		{
			if($this->_checkTable($table))
			{
				$this->_q="insert into $table values(";
			
				foreach($data as $val)
				{
					$this->_q.="'$val',";
				}
				$this->_trim();
				$this->_q.=")";
				
				if(mysqli_query($this->_con,$this->_q))
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				die("$table not Found in Database");
			}
			
			//echo $this->_q;
		}
		else{
			die("Data should be an array");
		}
	}

	public function insert($data,$table)
	{

		if(is_array($data))
		{
			if($this->_checkTable($table))
			{
				$this->_q="insert into $table(";
				
				$fields = "";
				$values = "";
				foreach($data as $field=>$val)
				{
					$fields.="$field,";
					$values.="'$val',";

				}
				$this->_q.=$fields;
			
				$this->_trim();
				
				$this->_q.=") values($values";
				
				$this->_trim();
				
				$this->_q.=")";
				
				if(mysqli_query($this->_con,$this->_q))
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				die("$table not Found in Database");
			}
			
			//echo $this->_q;
		}
		else{
			die("Data should be an array");
		}
	}

	public function getAllData($table)
	{
		if($this->_checkTable($table))
		{
			$this->_q="select * from $table";
			if($res=mysqli_query($this->_con,$this->_q))
			{
				if(mysqli_num_rows($res))
				{
					$data = array();
					while($row=mysqli_fetch_assoc($res))
					{
						$data[]=$row;
					}
					return $data;
				}
			}			
		}
		else
		{
			die("$table not Found");
		}
		return false;
	}

	public function lastQuery()
	{
		return $this->_q;
	}
	private function _trim()
	{
		$this->_q=substr($this->_q,0,strlen($this->_q)-1);
	}
	private function _checkTable($table)
	{
		$q="show tables";
		if($res=mysqli_query($this->_con,$q))
		{
			while($row=mysqli_fetch_array($res))
			{
				if($table==$row[0])
				{
					return true;
				}
			}
		}
		return false;

	}


}

?>