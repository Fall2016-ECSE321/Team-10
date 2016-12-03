<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Menu</title>
		<style>
			.error {color:#FF0000;}
		</style>	
	</head>
	<body style="background-color:Azure;">
	
<div id="menu" style="background-color:Wheat ;height:1000px;width:110px;float:left;">
<b>
<form action = "/FTMSphp/FTMSphp/index.php" method ="post">		
<p><input type="submit" value="Back" style="font-family:arial;font-size:20px;background-color:FloralWhite ;height:30px; width:110px;" ></p>
</form>
</b><br>
<form action = "/FTMSphp/FTMSphp/Employee/employeeview.php" method ="post">		
<p><input type="submit" value="Employee" style="font-family:arial;font-size:20px;background-color:FloralWhite ;height:30px; width:110px;" ></p>
</form><br>
<form action = "/FTMSphp/FTMSphp/Ingredient/ingredientview.php" method ="post">		
<p><input type="submit" value="Ingredient" style="font-family:arial;font-size:20px;background-color:FloralWhite ;height:30px; width:110px;" ></p>
</form><br>
<form action = "/FTMSphp/FTMSphp/Equipment/equipmentview.php" method ="post">		
<p><input type="submit" value="Equipment" style="font-family:arial;font-size:20px;background-color:FloralWhite ;height:30px; width:110px;" ></p>
</form><br>
</div>

<div id="content" style="height:800px;width:1000px;float:left;">

<h1 style="font-family:arial;font-size:50px;" align="center";>Menu</h1>

<div id="content" style="height:150px;width:300px;float:Right;">
<b>
<form action = "adddishview.php" method ="post">		
		<p align="center"><input  style="font-family:arial;font-size:30px;  ;height:50px; width:200px;" type="submit" value="Add dish"></p>
		</form>
</b> 		
		<form action = "addorderview.php" method ="post">		
		<p align="center"><input style="font-family:arial;font-size:30px;  ;height:50px; width:200px;" type="submit" value="Add order"></p>
		</form>
</b> <br>
</div>		
		
		
		
		
		<table border="2" width="1000" cellspacing="5" cellpadding="5"
		align="center" id="foodtable" style="background-color:GhostWhite;" >
		<tr>  
		<td style="font-family:arial;font-size:30px;">No.</td>
		<td style="font-family:arial;font-size:30px;">Food Name</td>
		<td style="font-family:arial;font-size:30px;">Price</td>
		<td style="font-family:arial;font-size:30px;">TotalOrdered</td>
		<td style="font-family:arial;font-size:30px;">Operation</td>
		</tr>
		<?php 
		require_once '../model/Food.php';
		require_once '../model/FoodTruckManager.php';
		require_once '../persistence/PersistenceFTMS.php';
		
		
		session_start();
		
		//Retrieve the data from the model
		$pm = new PersistenceFTMS();
		$rm = $pm->loadDataFromStore();

		
		foreach($rm -> getFoods() as $food){
			echo "<tr>";
			echo "<td><p>";
			$index=$rm->indexOfFood($food);
			echo  $index;
			echo "</p></td>";
			echo "<td><p>";
			echo $food ->getName();
			echo "</p></td>";
			echo "<td><p>";
			echo $food ->getPrice();
			echo "</p></td>";
			echo "<td><p>";
			echo $food ->getTotalOrdered();
			echo "</p></td>";
			
			echo "<td><form action ='/FTMSphp/FTMSphp/Menu/editdishview.php?id=";
			echo $index;
			echo "'method = 'post'>";
			echo "<p><input type='submit' value='Edit'></p>";
			echo "</form>";
			
			echo "<form action ='/FTMSphp/FTMSphp/Menu/removedish.php?id="; 
			echo  $index;
			echo "'method = 'post'>";
			echo "<p><input type='submit' value='Remove'></p>";
			echo "</form></td>";
			
			
			echo "</tr>";
		}
		
		
		?>
		<tr>
		</tr>
		</table>
</div>		
	</body>
</html>