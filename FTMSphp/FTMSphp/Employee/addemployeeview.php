<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Add employee</title>
		<style>
			.error {color:#FF0000;}
		</style>	
	</head>
	<body style="background-color:Azure;">
		<form action = "employeeview.php" method ="post">		
		<p><input type="submit" value="Back"></p>
		</form>

		
		<?php 
	
		require_once '../model/Employee.php';
		require_once '../model/FoodTruckManager.php';
		require_once '../persistence/PersistenceFTMS.php';
	
		session_start();
		
		//Retrieve the data from the model
		$pm = new PersistenceFTMS();
		$rm = $pm->loadDataFromStore();
		
		echo "<form action ='/FTMSphp/FTMSphp/index.php' method = 'post'>";
		//Name?
		echo "<p>Employees List:<select name = 'Employeespinner'>";
		foreach($rm -> getEmployees() as $employee){
			echo "<option>" . $employee ->getName ().  "_Role:" . $employee ->getRole ()."</option>";
		}
		echo"</select></p>";
		echo "</form>";
	
		
		?>
		
	<!--//Name? Add employee-->
		<form action = "addemployee.php" method ="post">
		<p>Name: <input type="text" name="employee" /></p>
		<p>Role: <input type="text" name="employeerole" /></p>
		<p>Worktime: <input type="text" name="employeeworktime" /> Please follow the format: Weekday.starttime-endtime,  ex. Mon.0800-1700, use ',' to seperate,</p>
		
		<span class="error">
			<?php 
			if (isset($_SESSION['errorEmployee']) && !empty($_SESSION['errorEmployee'])) {
				echo " * " . $_SESSION["errorEmployee"];
			}
			?>
		</span>
		
		<p><input type="submit" value="Add Employee"/></p>
		</form>
		
		
	</body>
</html>