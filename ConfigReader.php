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
		return $this->_xml->config->sqlite_path;
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
			$this->_xml = simplexml_load_file($this->_configFileLoc);
			echo "Successfully loaded file.\n";
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}

}

?>