<?php
require_once dirname(__DIR__).'/model/Equipment.php';
require_once dirname(__DIR__).'/model/FoodTruckManager.php';
require_once dirname(__DIR__).'/persistence/PersistenceFTMS.php';
require_once dirname(__DIR__).'/Equipment/equipmentview.php';
require_once dirname(__DIR__).'/controller/Controller.php';

$c = new Controller ();

try {
	$c->removeequipment ( $index=$_GET['id']);
	$_SESSION ["errorFoodName"] = "";
} catch ( Exception $e ) {
	$_SESSION["errorFoodName"] = $e->getMessage();
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="refresh" content="0; url=equipmentview.php" />
	</head>
</html>
