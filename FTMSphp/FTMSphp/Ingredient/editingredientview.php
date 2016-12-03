<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Ingredient</title>
<style>
.error {
	color: #FF0000;
}
</style>
</head>
<body style="background-color:Azure;">

<form action="/FTMSphp/FTMSphp/Ingredient/ingredientview.php" method="post">
	<p>
		<input type="submit" value="Back">
	</p>
</form>
<p>Editting dish:</p>
<table border="2" width="500" cellspacing="5" cellpadding="5"
		 id="foodtable" style="background-color:GhostWhite;">
<tr>  
		<td style="font-family:arial;font-size:20px;">No.</td>
		<td style="font-family:arial;font-size:20px;">Ingredient</td>
		<td style="font-family:arial;font-size:20px;">Quantity</td>
</tr>

<tr>
<?php 
require_once '../persistence/PersistenceFTMS.php';
require_once '../model/FoodTruckManager.php';
require_once '../model/Ingredient.php';
$pm = new PersistenceFTMS();
$rm = $pm->loadDataFromStore();
$index=$_GET['id'];
$ingredient= $rm->getIngredient_index($index);

echo "<td>";
echo $index;
echo "</td>";
echo "<td>";
echo $ingredient->getName();
echo "</td>";
echo "<td>";
echo $ingredient->getQuantity();
echo "</td>";
?>
</tr>
</table>

<?php 
echo "<form action ='editingredient.php?id2=";
echo  $index;
echo "'method = 'post'>";
?>
	<p>	
		New Ingredientname: <input type="text" name="newingredientname" />
	</p>
	<p>
		New Quantity: <input type="text" name="newingredientquantity" /> 
	</p>
	
	<span class="error">
			<?php 
			if (isset($_SESSION['errorEditIngredient']) && !empty($_SESSION['errorEditIngredient'])) {
				echo " * " . $_SESSION["errorEditIngredient"];
			}
			?>
			</span>
	<p>
		<input type="submit" value="Edit Ingredient" />
	</p>
</form>


</body>
</html>
