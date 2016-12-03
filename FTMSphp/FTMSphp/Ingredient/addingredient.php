<?php
require_once dirname(__DIR__).'/controller/Controller.php';

session_start ();

$c = new Controller ();
try {
	$c->createingredient( $_POST ['ingredientname'],$_POST ['ingredientquantity']);
	$_SESSION ["errorIngredient"] = "";
	
} catch ( Exception $e ) {
$_SESSION["errorIngredient"] = $e->getMessage();

} 

?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="refresh" content="0; url=addingredientview.php" />
	</head>
</html>