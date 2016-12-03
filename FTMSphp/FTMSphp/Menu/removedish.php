<?php
require_once dirname(__DIR__).'/model/Food.php';
require_once dirname(__DIR__).'/model/FoodTruckManager.php';
require_once dirname(__DIR__).'/persistence/PersistenceFTMS.php';
require_once dirname(__DIR__).'/Menu/menuview.php';
require_once dirname(__DIR__).'/controller/Controller.php';

$c = new Controller ();

try {
	$c->removefood ( $index=$_GET['id']);
	$_SESSION ["errorFoodName"] = "";
} catch ( Exception $e ) {
	$_SESSION["errorFoodName"] = $e->getMessage();
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="refresh" content="0; url=menuview.php" />
	</head>
</html>