<?php

// avoid using helper objects
//include './GenericHelper.php';

//$helper = new GenericHelper();

//$helper->toString();

// include './ConfigReader.php';

// $configReader = new ConfigReader('./config.xml');
// $sqliteLoc = "";

// echo $configReader->getFileLoc() . "\n";
// echo $configReader->getDBLoc() . "\n";




include './SQLiteReader.php';
//include './MySQLExecutor.php';
include './MSSQLExecutor.php';

$sqliteReader = new SQLiteReader();

$assoc_array = $sqliteReader->getCommand(2);

echo "Command Text: " . $assoc_array[0]['command_text'] . "\n";
echo "Hostname: " . $assoc_array[0]['hostname'] . "\n";
echo "DB_Name: " . $assoc_array[0]['db_name'] . "\n";
echo "Connection String: " . $assoc_array[0]['connection_string'] . "\n";
echo "Connection Type: " . $assoc_array[0]['connection_type'] . "\n";
echo "Command User: " . $assoc_array[0]['command_user'] . "\n";
echo "Command Pass: " . $assoc_array[0]['command_pass'] . "\n";

echo "\n";

echo (string)$sqliteReader;

$mySQLExecutor = new MSSQLExecutor($assoc_array[0]['hostname'], $assoc_array[0]['db_name'], $assoc_array[0]['connection_string'], $assoc_array[0]['command_user'], 
	$assoc_array[0]['command_pass'], $assoc_array[0]['command_text']);

//$new_assoc_array = $mySQLExecutor->execute($mySQLExecutor::$JSON);
$new_assoc_array = $mySQLExecutor->execute($mySQLExecutor::$XML);


echo $new_assoc_array;

/**
foreach($new_assoc_array as $row) {
	echo "prod_id: " . $row['prod_id'] . "\n";
	echo "name: " . $row['name'] . "\n";
	echo "description: " . $row['description'] . "\n";
	echo "revision: " . $row['revision'] . "\n";
	echo "product category: " . $row['product_category'] . "\n";
	echo "\n";
}
**/

?>