<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Equipment</title>
<style>
.error {
	color: #FF0000;
}
</style>
</head>
<body style="background-color:Azure;">
<form action="/FTMSphp/FTMSphp/Equipment/equipmentview.php" method="post">
	<p>
		<input type="submit" value="Back">
	</p>
</form>
<p>Editting equipment:</p>
<table border="2" width="500" cellspacing="5" cellpadding="5"
		 id="foodtable" style="background-color:GhostWhite;">
<tr>  
		<td style="font-family:arial;font-size:20px;">No.</td>
		<td style="font-family:arial;font-size:20px;">Equipment</td>
		<td style="font-family:arial;font-size:20px;">Quantity</td>
</tr>

<tr>
<?php 
require_once '../persistence/PersistenceFTMS.php';
require_once '../model/FoodTruckManager.php';
require_once '../model/Equipment.php';
$pm = new PersistenceFTMS();
$rm = $pm->loadDataFromStore();
$index=$_GET['id'];
$equipment= $rm->getEquipment_index($index);

echo "<td>";
echo $index;
echo "</td>";
echo "<td>";
echo $equipment->getName();
echo "</td>";
echo "<td>";
echo $equipment->getQuantity();
echo "</td>";
?>
</tr>
</table>

<?php 
echo "<form action ='editequipment.php?id2=";
echo  $index;
echo "'method = 'post'>";
?>
	<p>	
		New Equipmentname: <input type="text" name="newequipmentname" />
	</p>
	<p>
		New Quantity: <input type="text" name="newequipmentquantity" /> 
	</p>
	<p>
		<input type="submit" value="Edit Equipment" />
	</p>
</form>


</body>
</html>
