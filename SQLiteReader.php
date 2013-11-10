<?php

include './ConfigReader.php';

class SQLiteReader
{
	private $_sqliteDBLoc;
	private $_sqliteDB;
	
	public function getDBLoc()
	{
		return $this->$_sqliteDBLoc;
	}
	
	// constructor
	public function __construct()
	{
		$configReader = new ConfigReader('./config.xml');
		$this->_sqliteDBLoc = $configReader->getDBLoc();
		try 
		{
			$this->_sqliteDB = new PDO('sqlite:' . $this->_sqliteDBLoc);
			$this->_sqliteDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			// uses native method
			//$this->_sqliteDB = new SQLite3($this->_sqliteDBLoc, SQLITE3_OPEN_READONLY);			
		}
		catch (Exception $ex)
		{
			die($ex->getMessage());
		}
	}
	
	public function getCommand($commandNum)
	{
		$result = $this->_sqliteDB->query('SELECT command_text, connection_string, connection_type, command_user, command_pass FROM commands WHERE command_id = ' . $commandNum . ';');
		$res = $result->fetchAll(PDO::FETCH_ASSOC);
		// uses native method
		//$res = $result->fetchArray();
		return $res;
	}
	
	//private methods
	private function loadXML()
	{
		try {
			// attempt to load config file, throw exception if not found
			if (!$this->_xml = simplexml_load_file($this->_configFileLoc))
			{
				throw new Exception("Error loading file.");
			}
			else 
			{
				echo "Successfully loaded file.\n";
				print_r($this->_xml);
			}
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

}

?>