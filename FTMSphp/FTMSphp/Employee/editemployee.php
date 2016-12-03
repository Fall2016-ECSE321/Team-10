<?php
require_once dirname(__DIR__).'/controller/Controller.php';

session_start ();

$d = new Controller ();
try {
	$d->editemployee( $_GET['id2'],$_POST ['newname'],$_POST ['newrole'],$_POST ['newroktime']);
	$_SESSION ["errorEmployee"] = "";
} catch ( Exception $e ) {
$_SESSION["errorEmployee"] = $e->getMessage();
} 

?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="refresh" content="0; url=employeeview.php" />
	</head>
</html>