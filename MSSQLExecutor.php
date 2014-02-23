<?php
/*** Note:
   * Need to use the PDO driver due to the ms_sql driver being deprecated in PHP 5.3 and later.
   * However, it is still necessary to install FreeTDS library and php_mssql support.
   */

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
			$this->_db = new PDO('dblib:host=' . $this->_hostName . ';dbname=' . $this->_db_name,
					$this->_commandUser, $this->_commandPass);
			$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function __toString()
	{
		return "Instance of MSSQLExecutor Class:
				\nConnection String: " . 'mssql:host=' . $this->_hostName . ',1433;dbname=' . $this->_db_name . "\n";
	}
	
	public function execute($fetch_type)
	{
		$res;
		
		// using PDO query (non-prepared statement)
		try
		{
			$statement = $this->_db->query($this->_commandString);
			$res_array = $statement->fetchAll(PDO::FETCH_ASSOC);
					
			if ($fetch_type == Executor::$XML)
			{
				
				$res=OEUtils::xml_encode($res_array);
			}
			else
			{
				$res=json_encode($res_array);
			}
		}
		catch (PDOException $ex)
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