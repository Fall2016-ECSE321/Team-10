<?php
require_once dirname(__DIR__).'/controller/Controller.php';

session_start ();

$c = new Controller ();
try {
	$c->addorder($_POST ['foodspinner'],$_POST ['dishordered']);
	$_SESSION ["errorOrder"] = "";
} catch ( Exception $e ) {
	$_SESSION["errorOrder"] = $e->getMessage();
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="refresh" content="0; url=menuview.php" />
	</head>
</html>
