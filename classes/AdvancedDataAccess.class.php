<?php
require_once("DataAccess.class.php");

class AdvancedDataAccess extends DataAccess
{
	public function delete($table,$condition)
	{
		$flag=true;
		if($this->_checkTable($table))
		{
			$this->_query="delete from $table where $condition";
			if(!mysqli_query($this->_con,$this->_query))
			{
				$flag=false;
			}
		}
		else
		{
			$this->_errors="$table not found";
			$flag=false;
		}
		return $flag;

	}

	

}


?>