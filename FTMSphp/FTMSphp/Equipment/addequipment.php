<?php
require_once dirname(__DIR__).'/controller/Controller.php';

session_start ();

$c = new Controller ();
try {
	$c->createequipment( $_POST ['equipmentname'],$_POST ['equipmentquantity']);
	$_SESSION ["errorEquipment"] = "";
} catch ( Exception $e ) {
$_SESSION["errorEquipment"] = $e->getMessage();
} 
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="refresh" content="0; url=addequipmentview.php" />
	</head>
</html>