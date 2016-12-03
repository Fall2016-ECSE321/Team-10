<?php
require_once dirname(__DIR__).'/controller/Controller.php';

session_start ();

$d = new Controller ();
try {
	$d->editingredient( $_GET['id2'],$_POST ['newingredientname'],$_POST ['newingredientquantity']);
	$_SESSION ["errorEditIngredient"] = "";
} catch ( Exception $e ) {
$_SESSION["errorEditIngredient"] = $e->getMessage();
} 

?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="refresh" content="0; url=ingredientview.php" />
	</head>
</html>