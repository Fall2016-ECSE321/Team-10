<?php
require_once dirname(__DIR__).'/controller/Controller.php';

session_start ();

$c = new Controller ();
try {
	$c->createfood ( $_POST ['dishname'],$_POST ['dishprice']);
	$_SESSION ["errorFood"] = "";
} catch ( Exception $e ) {
$_SESSION["errorFood"] = $e->getMessage();
} 


?>

<!DOCTYPE html>
<html>
	<head>
		  <meta http-equiv="refresh" content="0; url=adddishview.php" />
	</head>
</html>