<?php

include './Executor.php';
include './OEUtils.php';

class MySQLExecutor extends Executor
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
		
		// PDO Method	
		/*	
		try
		{
			$this->_db = new PDO($this->_connectionString, $this->_commandUser, $this->_commandPass, 
					array(PDO::ATTR_EMULATE_PREPARES => false,
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}
		catch (PDOException $ex)
		{
			echo $ex->getMessage();
		}
		*/
		
		// mysqli method
		try
		{
			$this->_db = new mysqli($this->_hostName, $this->_commandUser, $this->_commandPass, 
					$this->_db_name);
		}
		catch (mysqli_sql_exception $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function __toString()
	{
		return "Instance of MySQLExecutor Class:
				\nConnection String: " . $this->_connectionString . "\n";
	}
	
	public function execute($fetch_type)
	{
		$res;
		
		// PDO Method
		
		/**
		try
		{	 
			$stmt = $this->_db->prepare($this->_commandString);
			$stmt->execute();
			if ($fetch_type == Executor::$XML)
			{
				$res=OEUtils::xml_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
			}
			else 
			{
				$res=json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
			}
			//$res = $stmt->fetch(PDO::FETCH_OBJ);
		} 
		catch(PDOException $ex) 
		{
			echo $ex->getMessage();
		}
		**/
		
		
		// using mysqli prepared statement
		/**
		try 
		{
			$stmt = $this->_db->prepare($this->_commandString);
			$stmt->execute();
			//$column = $stmt->result_metadata()->fetch_fields();
			
			// build columns
			$stmt->bind_result($result);
			$stmt->fetch();
			
			//$res_array = array();
			
			while ($row = $result->fetch_assoc()) {
				$res_array[] = $row;
			}
			
			for ($x = 1; $x<$res_array->length; $x++)
			{
				echo $res_array[0];
			}
			
			if ($fetch_type == Executor::$XML)
			{
				$res=OEUtils::xml_encode($result->fetch_array(MYSQLI_ASSOC));
			}
			else
			{
				$res=json_encode($result->fetch_array(MYSQLI_ASSOC));
			}
		}
		catch (mysqli_sql_exception $ex)
		{
			echo $ex->getMessage();
		}
		**/
		
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