<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Add Dish</title>
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
		
		echo "<form action ='/FTMSphp/FTMSphp/index.php' method = 'post'>";
		//Name?
		echo "<p>Dishes List:<select name = 'foodspinner'>";
		foreach($rm -> getFoods() as $food){
			echo "<option>" . $food ->getName (). "_Price:" . $food ->getPrice ()."</option>";
		}
		echo"</select><span class = 'error'>";
		echo "</span></p>";
		echo "</form>";
		

		
		?>
		
	<!--//Name? Add participant-->
		<form action = "adddish.php" method ="post">
		<p>Name: <input type="text" name="dishname" />
		<span class = "error">
		<?php 
		
		if (isset($_SESSION['errorFoodName'])&& !empty($_SESSION['errorFoodName'])){
			echo "*" .$_SESSION["errorFoodName"];
		}
		
		?>
		</span></p>
		
		<p>Price: <input type="text" name="dishprice" />
		
		</span></p>
		
		<span class="error">
			<?php 
			if (isset($_SESSION['errorFood']) && !empty($_SESSION['errorFood'])) {
				echo " * " . $_SESSION["errorFood"];
			}
			?>
			</span>
		<!-- add dish button -->
		<p><input type="submit" value="Add Dish"/></p>
		</form>
		
	
		
		
		
	
		
	</body>
</html>