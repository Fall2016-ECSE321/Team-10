<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>FTMS</title>
		<style>
			.error {color:#FF0000;}
		</style>	
	</head>
	<div id="container" style="width:800px">
	<h1 style="font-family:arial;font-size:50px;" align="center";>Food Truck Management System</h1>
	

	<body style="background-color:Azure;">
	<div style="font-family:verdana;padding:20px;border-radius:10px;border:10px solid #EE872A;background-color:LightCyan  ;">
	
		
		<form action = "/FTMSphp/FTMSphp/Employee/employeeview.php" method ="post">		
		<p align="center";><input style="font-family:arial;font-size:40px;background-color:FloralWhite ;height:60px; width:250px;" type="submit" value="Employee"></p>
		</form>
		
		<form action = "/FTMSphp/FTMSphp/Ingredient/ingredientview.php" method ="post">		
		<p align="center";><input style="font-family:arial;font-size:40px;background-color:FloralWhite ;height:60px; width:250px;" type="submit" value="Ingredient"></p>
		</form>
		
		
		<form action = "/FTMSphp/FTMSphp/Equipment/equipmentview.php" method ="post">		
		<p align="center";><input style="font-family:arial;font-size:40px;background-color:FloralWhite ;height:60px; width:250px;" type="submit" value="Equipment"></p>
		</form>
		
		<form action = "/FTMSphp/FTMSphp/Menu/menuview.php" method ="post">		
		<p align="center";><input style="font-family:arial;font-size:40px;background-color:FloralWhite ;height:60px; width:250px;" type="submit" value="Menu"></p>
		</form>
	
	</div>	
	</div>	
	</body>
</html>