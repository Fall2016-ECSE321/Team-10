<?php
require_once dirname(__DIR__).'/controller/Controller.php';

session_start ();

$c = new Controller ();
try {
	$c->createemployee( $_POST ['employee'],$_POST ['employeerole'],$_POST['employeeworktime']);
	$_SESSION ["errorEmployee"] = "";
} catch ( Exception $e ) {
$_SESSION["errorEmployee"] = $e->getMessage();
} 
?>

<!DOCTYPE html>
<html>
	<head>
	  
	  <meta http-equiv="refresh" content="0; url=addemployeeview.php" />
	</head>
</html>