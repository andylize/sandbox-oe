<?php

// avoid using helper objects
//include './GenericHelper.php';

//$helper = new GenericHelper();

//$helper->toString();

include './ConfigReader.php';

$configReader = new ConfigReader('./config.xml');
$sqliteLoc = "";

echo $configReader->getFileLoc() . "\n";
echo $configReader->getDBLoc() . "\n";


?>