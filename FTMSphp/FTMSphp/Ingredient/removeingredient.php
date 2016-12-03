<?php
require_once dirname(__DIR__).'/model/Ingredient.php';
require_once dirname(__DIR__).'/model/FoodTruckManager.php';
require_once dirname(__DIR__).'/persistence/PersistenceFTMS.php';
require_once dirname(__DIR__).'/Ingredient/ingredientview.php';
require_once dirname(__DIR__).'/controller/Controller.php';

$c = new Controller ();

try {
	$c->removeingredient ( $index=$_GET['id']);
	$_SESSION ["errorFoodName"] = "";
} catch ( Exception $e ) {
	$_SESSION["errorFoodName"] = $e->getMessage();
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="refresh" content="0; url=ingredientview.php" />
	</head>
</html>
