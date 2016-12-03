<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Add Ingredient</title>
		<style>
			.error {color:#FF0000;}
		</style>	
	</head>
	<body style="background-color:Azure;">
		 
		<form action = "/FTMSphp/FTMSphp/Ingredient/ingredientview.php" method ="post">		
		<p><input type="submit" value="Back"></p>
		</form>
		
		<?php 
	
		require_once '../model/Ingredient.php';
		require_once '../model/FoodTruckManager.php';
		require_once '../persistence/PersistenceFTMS.php';
		

		session_start();
		
		//Retrieve the data from the model
		$pm = new PersistenceFTMS();
		$rm = $pm->loadDataFromStore();
		
		echo "<form action ='/FTMSphp/FTMSphp/index.php' method = 'post'>";
		//Name?
		echo "<p>Ingredients List:<select name = 'ingredientspinner'>";
		foreach($rm -> getIngredients() as $ingredient){
			echo "<option>" . $ingredient ->getName (). "_Quantity:".$ingredient ->getQuantity ()."</option>";
		}
		echo"</select></p>";
		echo "</form>";
	
		
		?>
		
	<!--//Name? Add participant-->
	
			
			
		<form action = "addingredient.php" method ="post">
		<p>Name: <input type="text" name="ingredientname" /></p>
		
	
		<p>Quantity: <input type="text" name="ingredientquantity" /></p>
			<!-- Ingredient number must be numberic -->
			
		<!-- validation check -->
		<!-- Ingredient name cannot be empty -->
		
		
	<span class="error">
			<?php 
			if (isset($_SESSION['errorIngredient']) && !empty($_SESSION['errorIngredient'])) {
				echo " * " . $_SESSION["errorIngredient"];
			}
			?>
			</span>
		<p><input type="submit" value="Add Ingredient"/></p>
		</form>
		
		
	</body>
</html>