<?php

class ConfigReader
{
	private $_configFileLoc;
	private $_xml;

	public function getFileLoc()
	{
		return $this->_configFileLoc;
	}
	
	public function getDBLoc()
	{
		echo $this->_xml;
		return $this->_xml->sqlite_path;
	}
	
	// constructor
	public function __construct($fileLoc)
	{
		$this->_configFileLoc = $fileLoc;
		$this->loadXML();
	}
	
	public function __toString()
	{
		return "ConfigReader class for the file: " . $this->_configFileLoc;
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
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
}

?>