<?php

class DataAccess
{
	protected $_con,$_query,$_errors;
	
	public function __construct()
	{
		if(!$this->_con=mysqli_connect("localhost","root","","ngmart_db"))
		{
			die("connection Error");
		}
		$this->_errors ="";
	}
	
	public function insertFull($data,$table)
	{
		$flag=true;
		if(!$this->_checkTable($table))
		{
			$flag=false;
			$this->_errors.="<p>table $table not exist</p>";
		}
		else
		{
			if(is_array($data))
			{
				$arrLength = count($data);
				$numFields = $this->_numFields($table);
				if($arrLength != $numFields)
				{						
					$flag=false;
					$this->_errors .="<p>$table contains $numFields columns and u supplied $arrLength items</p>";
				}
				
			}
			else
			{
				$flag=false;
				$this->_errors .="<p>first parameter should be an array</p>";
			}
		}
		if($flag)
		{
			$this->_query="insert into $table values(";
				// $this->_query."<br>";
			foreach($data as $val)
			{
				
				$this->_query.="'$val',";
						// $this->_query."<br>";
			}
			$this->_chopQuery();
					// $this->_query."<br>";
			$this->_query.=")";
					// $this->_query."<br>";
			if(mysqli_query($this->_con,$this->_query))
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
			return false;
		}
		
	}
	public function insert($data,$table)
	{
		$flag=true;
		if(!$this->_checkTable($table))
		{
			$flag=false;
			$this->_errors.="<p>table $table not exist</p>";
		}
		else if(!is_array($data))
		{
			
			$flag=false;
			$this->_errors .="<p>first parameter shold be an array</p>";
			
		}
		else if(!$this->_checkFields($data,$table))
		{
			$flag=false;
		}
		if($flag)
		{
			$this->_query="insert into $table (";
			//adding Field list to query
			//  $this->_query."<br>";
			foreach($data as $index=>$val)
			{
				
				$this->_query.="$index,";
						//  $this->_query."<br>";
			}
			$this->_chopQuery();
					//  $this->_query."<br>";
			$this->_query.=") values(";
			foreach($data as $val)
			{
				
				$this->_query.="'$val',";
						//  $this->_query."<br>";
			}
			$this->_chopQuery();
			$this->_query.=")";
					//  $this->_query."<br>";
			if(mysqli_query($this->_con,$this->_query))
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
			return false;
		}
		
	}
	
	public function getAllData($table)
	{
		$this->_query="select * from $table";
		if($resref = mysqli_query($this->_con,$this->_query))
		{
			if(mysqli_num_rows($resref))
			{
				$dataArr=array();
				while($row=mysqli_fetch_assoc($resref))
				{
					$dataArr[] = $row;
				}
				
				return $dataArr;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	// function to select specific data from query
	public function getData($fields,$table,$condition = "1")
	{
		if(!$this->_checkTable($table))
		{
			$this->_errors.="$table not Present";
			return false;
		}
		$this->_query = "select ";
		 $this->_query."<br>";
		
		if(is_array($fields))
		{
			if($this->_checkFieldsIndexed($fields,$table))
			{
				$this->_query.=implode(",",$fields);
				 $this->_query."<br>";
			}
			else
			{
				return false;
			}
		}
		else if(gettype($fields) == "string")
		{
			if($fields == "*")
			{
				$this->_query.="*";
				 $this->_query."<br>";
			}
			else if($this->_checkFieldsIndexed(array($fields),$table))
			{
				$this->_query.=$fields;
				 $this->_query."<br>";
			}
			else
			{
				return false;
			}
		}
		else
		{
			$this->_errors.=" Invalid type for fields";
			return false;
		}
		$this->_query.=" from $table where $condition";
	    $this->_query."<br>";
		$resref=mysqli_query($this->_con,$this->_query);
		$dataArr = array();
		if(mysqli_num_rows($resref))
		{		
			while($rows = mysqli_fetch_assoc($resref))
			{
				$dataArr[] = $rows;
			}
		}
		return $dataArr;
			
		
	}
	public function count($field,$table,$condition="1")
	{
		if($this->_checkTable($table))
		{
			if($this->_checkFieldsIndexed(array($field),$table))
			{
				$this->_query="select count($field) as count from $table where $condition";
				$resref= mysqli_query($this->_con,$this->_query);
				$row = mysqli_fetch_assoc($resref);
				return $row["count"];
			}
			else
			{
				return false;
			}
		}
		else
		{
			$this->_errors.="<p>$table not present</p>";
			return false;
		}
	}
	public function max($field,$table,$condition="1")
	{
		if($this->_checkTable($table))
		{
			if($this->_checkFieldsIndexed(array($field),$table))
			{
				$this->_query="select max($field) as max from $table where $condition";
				$resref= mysqli_query($this->_con,$this->_query);
				$row = mysqli_fetch_assoc($resref);
				return $row["max"];
			}
			else
			{
				return false;
			}
		}
		else
		{
			$this->_errors.="<p>$table not present</p>";
			return false;
		}
	}
	// check existance of a value in a table field
	public function checkExist($field,$value,$table,$condition="1")
	{
		if($this->_checkTable($table))
		{
			if($this->_checkFieldsIndexed(array($field),$table))
			{
				$this->_query ="select * from $table where $field='$value' and $condition";
				$resref = mysqli_query($this->_con,$this->_query);
				if(mysqli_num_rows($resref))
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
				return 0;
			}
		}
		else
		{
			$this->_errors .= "$table not present";
			return 0;
		}
	}
	
	// returns an array of selectbox,radiogroup,checkboxlist options as "label=>value"
	public function createOptions($labelField,$valField,$table,$condition = "1")
	{
		if($this->_checkTable($table))
		{
			if($this->_checkFieldsIndexed(array($labelField,$valField),$table))
			{
				$this->_query = "select $labelField,$valField from $table where $condition";
				
				$resref=mysqli_query($this->_con,$this->_query);
				$data = array();
				
				if(mysqli_num_rows($resref))
				{
					while($row=mysqli_fetch_assoc($resref))
					{
						$data[$row[$labelField]]=$row[$valField];
					}
					return $data;
				}
				else
				{
					return $data;
				}
				
			}
			else
			{
				return array();
			}
		}
		else
		{
			$this->_errors .= "$table not present";
			return 0;
		}
	}
	
	public function update($data,$table,$condition)
	{
		$flag=true;
		if(!$this->_checkTable($table))
		{
			$flag=false;
			die("<p>table $table not exist</p>");
		}
		else
		{
			if(!is_array($data))
			{
				$flag=false;
				die("<p>first parameter should be an array</p>");
				
			}
			
		}
		if($flag)
		{
			$this->_query="update $table set ";
				// $this->_query."<br>";
			foreach($data as $ind=>$val)
			{
				
				$this->_query.="$ind='$val',";
						// $this->_query."<br>";
			}
			$this->_chopQuery();
					// $this->_query."<br>";
			$this->_query.="where $condition";
					// $this->_query."<br>";
			if(mysqli_query($this->_con,$this->_query))
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
			return false;
		}
	}
	
	
	// function that returns the errors generated while creating a query
	public function getErrors()
	{
		return $this->_errors;
	}
	public function lastQuery()
	{
		return $this->_query;
	}
	protected function _checkTable($table)
	{
		$q="show tables";
		$resref = mysqli_query($this->_con,$q);
		if(mysqli_num_rows($resref))
		{
			while($row=mysqli_fetch_array($resref))
			{
				if($row[0]==$table)
				{
					return true;
				}
			}
		}
		return false;
	}
	private function _numFields($table)
	{
		
		if($this->_checkTable($table))
		{
			$q="describe $table";
			$resref = mysqli_query($this->_con,$q);
			return mysqli_num_rows($resref);
		}
		return 0;
		
	}
	private function _checkFields($data,$table)
	{
		if($this->_checkTable($table))
		{
			$fieldArr=array();
			//filling $fieldArr with fields in given table
			$q="describe $table";
			$resref = mysqli_query($this->_con,$q);
			
			while($row=mysqli_fetch_assoc($resref))
			{
				$fieldArr[] = $row["Field"];
			}
			//checking given fields in array with fields in table
			$flag = true;
			foreach($data as $index=>$val)
			{
				if(!in_array($index,$fieldArr))
				{
					$flag = false;
					$this->_errors .= "<p>$index not present in $table</p>";
				}
			}
			return $flag;
			
		}
		return 0;
	}
	private function _checkFieldsIndexed($data,$table)
	{
		if($this->_checkTable($table))
		{
			$fieldArr=array();
			//filling $fieldArr with fields in given table
			$q="describe $table";
			$resref = mysqli_query($this->_con,$q);
			
			while($row=mysqli_fetch_assoc($resref))
			{
				$fieldArr[] = $row["Field"];
			}
			//checking given fields in array with fields in table
			$flag = true;
			foreach($data as $val)
			{
				if(!in_array($val,$fieldArr))
				{
					$flag = false;
					$this->_errors .= "<p>$val not present in $table</p>";
				}
			}
			return $flag;
			
		}
		return 0;
	}
	private function _chopQuery()
	{
		$this->_query=substr($this->_query,0,strlen($this->_query)-1);
	}
}


?>
