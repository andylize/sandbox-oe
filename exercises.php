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

$sqliteReader = new SQLiteReader();

$assoc_array = $sqliteReader->getCommand(1);

echo "Command Text: " . $assoc_array[0][command_text] . "\n";
echo "Connection String: " . $assoc_array[0][connection_string] . "\n";
echo "Connection Type: " . $assoc_array[0][connection_type] . "\n";
echo "Command User: " . $assoc_array[0][command_user] . "\n";
echo "Command Pass: " . $assoc_array[0][command_pass] . "\n";

echo "\n";

echo (string)$sqliteReader;

?>