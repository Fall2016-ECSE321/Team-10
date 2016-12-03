<?php
require_once dirname(__DIR__).'/controller/Controller.php';

session_start ();

$d = new Controller ();
try {
	$d->editequipment( $_GET['id2'],$_POST ['newequipmentname'],$_POST ['newequipmentquantity']);
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