<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Add order</title>
		<style>
			.error {color:#FF0000;}
		</style>	
	</head>
	<body style="background-color:Azure;">
	
		<form action = "/FTMSphp/FTMSphp/Menu/menuview.php" method ="post">		
		<p><input type="submit" value="Back"></p>
		</form>
		<?php 
		require_once '../model/Food.php';
		require_once '../model/FoodTruckManager.php';
		require_once '../persistence/PersistenceFTMS.php';
		session_start();	
		//Retrieve the data from the model
		$pm = new PersistenceFTMS();
		$rm = $pm->loadDataFromStore();
		
		echo "<form action ='addorder.php' method = 'post'>";
		echo "<p>Dish:<select name = 'foodspinner'>";
		foreach($rm -> getFoods() as $food){
			echo "<option>" . $food ->getName ()."</option>";
		}
		echo"</select>";
		?>
		<p>Numberordered: <input type="text" name="dishordered" />
		<p><input type="submit" value="Add order"/></p>
		</form>
		
	</body>
</html>