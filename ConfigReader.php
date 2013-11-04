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
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}

}

?>