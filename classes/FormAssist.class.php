<?php

class FormAssist
{
	private $_dao,$_fields,$_str,$_errors;
	
	public function __construct($fields,$data)
	{
		if(is_array($fields))
		{
			
			if(empty($data))
			{
				$this->_fields  = $fields;
			}
			else
			{
				foreach($fields as $ind=>$val)
				{
					if(!isset($data[$ind]))
					{
						$data[$ind]="";
					}
				}
				$this->_fields=$data;
				
				
			}
		}
		else
		{
			die("pass array to constructor");
		}
		
		$_errors="";
	}
	
	public function textBox($name,$attributes)
	{
		$this->_str="";
		
		if(isset($this->_fields[$name]))
		{
			$this->_str .="<input type='text' name='$name' ".$this->_attributeString($attributes);
			if($this->_fields[$name]!=null)
			{
				$this->_str .="value='".$this->_fields[$name]."'";
			}
			$this->_str .=" />";
			return $this->_str;
		}
		else
		{
			$this->_errors = "<p>$name not present in field list</p>";
			return "Error...";
		}
		
	}
	public function passwordBox($name,$attributes)
	{
		$this->_str="";
		
		if(isset($this->_fields[$name]))
		{
			$this->_str .="<input type='password' name='$name' ".$this->_attributeString($attributes);
			
			$this->_str .=" />";
			return $this->_str;
		}
		else
		{
			$this->_errors = "<p>$name not present in field list</p>";
			return "Error...";
		}
		
	}
	public function textArea($name,$attributes)
	{
		$this->_str="";
		
		if(isset($this->_fields[$name]))
		{
			$this->_str .="<textarea name='$name' ".$this->_attributeString($attributes)." >";
			if($this->_fields[$name]!=null)
			{
				$this->_str .=$this->_fields[$name];
			}
			$this->_str .="</textarea>";
			return $this->_str;
		}
		else
		{
			$this->_errors = "<p>$name not present in field list</p>";
			return "Error...";
		}
		
	}
	public function fileField($name,$attributes)
	{
		$this->_str="";
		
		if(isset($this->_fields[$name]))
		{
			$this->_str .="<input type='file' name='$name' ".$this->_attributeString($attributes)." />";			
			return $this->_str;
		}
		else
		{
			$this->_errors = "<p>$name not present in field list</p>";
			return "Error...";
		}
		
	}
	public function dropDownList($name,$attributes,$options,$default="select")
	{
		$this->_str="";
		if(isset($this->_fields[$name]))
		{
			$this->_str .="<select name='$name' ".$this->_attributeString($attributes)." >";
			if(is_array($options))
			{
				
				$this->_str.="<option selected='selected' disabled='disabled'>$default</option>";
				
				foreach($options as $label=>$value)
				{
					if($this->_fields[$name]==$value)
					{
						$this->_str.="<option selected='selected' value='$value'>$label</option>";
					}
					else
					{
						$this->_str.="<option value='$value'>$label</option>";
					}
					
				}
				$this->_str.="</select>";
			}
			else
			{
				$this->_errors.="<p>options provided to $name should be an array</p>";
				return "Error...";
			}
			return $this->_str;
		}
		else
		{
			$this->_errors .= "<p>$name not present in field list</p>";
			return "Error...";
		}
	}
	
	public function radioGroup($name,$attributes,$options,$vertical = false)
	{
		$this->_str="";
		if(isset($this->_fields[$name]))
		{
			
			if(is_array($options))
			{
				$verticalStr="";
				if($vertical)
				{
					$verticalStr="<br />";
				}
				foreach($options as $label=>$value)
				{
					if($this->_fields[$name]==$value)
					{
						$this->_str.="<label><input type='radio' name='$name'".$this->_attributeString($attributes). " value='$value' checked='checked' />$label</label>$verticalStr";
					}
					else
					{
						$this->_str.="<label><input type='radio' name='$name'".$this->_attributeString($attributes). " value='$value' />$label</label>$verticalStr";
					}
					
				}
				
			}
			else
			{
				$this->_errors.="<p>options provided to $name should be an array</p>";
				return "Error...";
			}
			return $this->_str;
		}
		else
		{
			$this->_errors .= "<p>$name not present in field list</p>";
			return "Error...";
		}
	}
	public function checkBoxList($name,$attributes,$options,$vertical = true)
	{
		$this->_str="";
		if(isset($this->_fields[$name]))
		{
			
			if(is_array($options))
			{
				$verticalStr="";
				if($vertical)
				{
					$verticalStr="<br />";
				}
				foreach($options as $label=>$value)
				{
					if(is_array($this->_fields[$name]))
					{
						if(in_array($value,$this->_fields[$name]))
						{
							$this->_str.="<label><input type='checkBox' name='$name"."[]' ".$this->_attributeString($attributes). " value='$value' checked='checked' />$label</label>$verticalStr";
						}
						else
						{
							$this->_str.="<label><input type='checkbox' name='$name"."[]".$this->_attributeString($attributes). " value='$value' />$label</label>$verticalStr";
						}
					}
					else
					{
						$this->_str.="<label><input type='checkbox' name='$name"."[]".$this->_attributeString($attributes). " value='$value' />$label</label>$verticalStr";
					}
					
				}
				
			}
			else
			{
				$this->_errors.="<p>options provided to $name should be an array</p>";
				return "Error...";
			}
			return $this->_str;
		}
		else
		{
			$this->_errors .= "<p>$name not present in field list</p>";
			return "Error...";
		}
	}	
	public function getErrors()
	{
		return $this->_errors;
	}
	private function _attributeString($attributes)
	{
		if(is_array($attributes))
		{
			$str="";
			foreach($attributes as $name=>$val)
			{
				$str.=" $name='$val' ";
			}
			return $str;
		}
		else
		{
			$this->_errors.="<p>atrributes should be an array</p>";
			return "";
		}
	}
}


?>
