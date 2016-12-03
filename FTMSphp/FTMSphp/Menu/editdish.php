<?php
require_once dirname(__DIR__).'/controller/Controller.php';

session_start ();

$d = new Controller ();
try {
	$d->editfood( $_GET['id2'],$_POST ['newdishname'],$_POST ['newdishprice'],$_POST['newtotalordered']);
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
