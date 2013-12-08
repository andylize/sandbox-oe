<?php

include './Executor.php';
include './OEUtils.php';

class MSSQLExecutor extends Executor
{	
	
	// constructor
	public function __construct($connectionString, $commandUser, $commandPass, $commandString)
	{
		$this->_connectionString = $connectionString;
		$this->_commandUser = $commandUser;
		$this->_commandPass = $commandPass;
		$this->_commandString = $commandString;
		
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
	}
	
	public function __toString()
	{
		return "Instance of MSSQLExecutor Class:
				\nConnection String: " . $this->_connectionString . "\n";
	}
	
	public function execute($fetch_type)
	{
		$res;
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
		
		//if (count($res)<1) {
			//$res[0] = "No results returned.";
		//}
		return $res;
	}
}

?>