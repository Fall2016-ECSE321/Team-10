<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Add Equipment</title>
		<style>
			.error {color:#FF0000;}
		</style>	
	</head>
	<body style="background-color:Azure;">
		 
		<form action = "/FTMSphp/FTMSphp/Equipment/equipmentview.php" method ="post">		
		<p><input type="submit" value="Back"></p>
		</form>
		
		<?php 
	
		require_once '../model/Equipment.php';
		require_once '../model/FoodTruckManager.php';
		require_once '../persistence/PersistenceFTMS.php';
		

		session_start();
		
		//Retrieve the data from the model
		$pm = new PersistenceFTMS();
		$rm = $pm->loadDataFromStore();
		
		echo "<form action ='/FTMSphp/FTMSphp/index.php' method = 'post'>";
		//Name?
		echo "<p>Equipments List:<select name = 'equipmentspinner'>";
		foreach($rm -> getEquipment() as $equipment){
			echo "<option>" . $equipment ->getName ()."_Quantity:".  $equipment ->getQuantity ()."</option>";
		}
		echo"</select></p>";
		echo "</form>";
		
		?>
		
	<!--//add equipment-->
		<form action = "addequipment.php" method ="post">
		<p>Name: <input type="text" name="equipmentname" /></p>
		<p>Quantity: <input type="text" name="equipmentquantity" /></p>
		<span class="error">
			<?php 
			if (isset($_SESSION['errorEquipment']) && !empty($_SESSION['errorEquipment'])) {
				echo " * " . $_SESSION["errorEquipment"];
			}
			?>
			</span>
		<p><input type="submit" value="Add Equipment"/></p>
		</form>
		
		
	</body>
</html>