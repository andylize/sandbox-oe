<?php

include './iExecutor.php';

abstract class Executor implements iExecutor
{
	public static $XML = 'XML';
	public static $JSON = 'JSON';
	
	protected $_db;
	protected $_commandString;
	protected $_connectionString;
	protected $_hostName;
	protected $_db_name;
	protected $_commandUser;
	protected $_commandPass;
	
	
	public function execute($fetch_type)
	{
		return "Executor Success";
	}
}


?>