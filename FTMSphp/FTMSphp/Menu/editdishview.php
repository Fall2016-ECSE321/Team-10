<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit dish</title>
<style>
.error {
	color: #FF0000;
}
</style>
</head>
<body style="background-color:Azure;">
<form action="/FTMSphp/FTMSphp/Menu/menuview.php" method="post" ">
	<p>
		<input type="submit" value="Back">
	</p>
</form>
<p>Editting dish:</p>
<table border="2" width="500" cellspacing="5" cellpadding="5"
		 id="foodtable" style="background-color:GhostWhite">
<tr>  
		<td style="font-family:arial;font-size:20px;">No.</td>
		<td style="font-family:arial;font-size:20px;">Food Name</td>
		<td style="font-family:arial;font-size:20px;">Price</td>
		<td style="font-family:arial;font-size:20px;">TotalOrdered</td>
</tr>

<tr>
<?php 
require_once '../persistence/PersistenceFTMS.php';
require_once '../model/FoodTruckManager.php';
require_once '../model/Food.php';
$pm = new PersistenceFTMS();
$rm = $pm->loadDataFromStore();
$index=$_GET['id'];
$food= $rm->getFood_index($index);

echo "<td>";
echo $index;
echo "</td>";
echo "<td>";
echo $food->getName();
echo "</td>";
echo "<td>";
echo $food->getPrice();
echo "</td>";
echo "<td>";
echo $food->getTotalOrdered();
echo "</td>";
?>
</tr>
</table>

<?php 
echo "<form action ='editdish.php?id2=";
echo  $index;
echo "'method = 'post'>";
?>
	<p>	
		New DishName: <input type="text" name="newdishname" />
	</p>
	<p>
		New Price: <input type="text" name="newdishprice" /> 
	</p>
	<p>
		New TotalOrdered:<input type="text" name="newtotalordered" /> 
	</p>
	<p>
		<input type="submit" value="Edit dish" />
	</p>
</form>


</body>
</html>
