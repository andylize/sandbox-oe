<?php

include './Executor.php';
include './OEUtils.php';

class MSSQLExecutor extends Executor
{	
	
	// constructor
	public function __construct($hostName, $db_name, $connectionString, $commandUser, $commandPass, $commandString)
	{
		$this->_hostName = $hostName;
		$this->_db_name = $db_name;
		$this->_connectionString = $connectionString;
		$this->_commandUser = $commandUser;
		$this->_commandPass = $commandPass;
		$this->_commandString = $commandString;
		
		try
		{
			$this->_db = new odbc_($this->_hostName, $this->_commandUser, $this->_commandPass, 
					$this->_db_name);
		}
		catch (mysqli_sql_exception $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function __toString()
	{
		return "Instance of MSSQLExecutor Class:
				\nConnection String: " . $this->_connectionString . "\n";
	}
	
	public function execute($fetch_type)
	{
		$res;
		
		// using mysqli query (non-prepared statement)
		try
		{
			$result = $this->_db->query($this->_commandString);
			
			for ($res_array = array(); $row = $result->fetch_assoc(); $res_array[] = $row);			
			if ($fetch_type == Executor::$XML)
			{
				
				$res=OEUtils::xml_encode($res_array);
			}
			else
			{
				$res=json_encode($res_array);
			}
			$result->free();
		}
		catch (mysqli_sql_exception $ex)
		{
			echo $ex->getMessage();
		}
		//if (count($res)<1) {
			//$res[0] = "No results returned.";
		//}
		return $res;
	}
}

?>