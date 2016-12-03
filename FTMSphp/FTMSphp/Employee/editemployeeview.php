<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Employee</title>
<style>
.error {
	color: #FF0000;
}
</style>
</head>
<body style="background-color:Azure;">
<form action="/FTMSphp/FTMSphp/Employee/employeeview.php" method="post">
	<p>
		<input type="submit" value="Back">
	</p>
</form>
<p>Editting Employee:</p>
<table border="2" width="500" cellspacing="5" cellpadding="5"
		 id="foodtable" style="background-color:GhostWhite;">
<tr>  
		<td style="font-family:arial;font-size:20px;">No.</td>
		<td style="font-family:arial;font-size:20px;">Employee</td>
		<td style="font-family:arial;font-size:20px;">Role</td>
		<td style="font-family:arial;font-size:20px;">Worktime</td>
</tr>

<tr>
<?php 
require_once '../persistence/PersistenceFTMS.php';
require_once '../model/FoodTruckManager.php';
require_once '../model/Employee.php';
$pm = new PersistenceFTMS();
$rm = $pm->loadDataFromStore();
$index=$_GET['id'];
$employee= $rm->getEmployee_index($index);

echo "<td>";
echo $index;
echo "</td>";
echo "<td>";
echo $employee->getName();
echo "</td>";
echo "<td>";
echo $employee->getRole();
echo "</td>";
echo "<td><p>";
			 
			$worktimes = explode(",", $employee->getWorktime());
			foreach ($worktimes as $worktime)
			{
				echo strtoupper($worktime);
				echo " and ";
			}		
			echo "</p></td>";
?>
</tr>
</table>

<?php 
echo "<form action ='editemployee.php?id2=";
echo  $index;
echo "'method = 'post'>";
?>
	<p>	
		New Employeename: <input type="text" name="newname" />
	</p>
	<p>
		New Role: <input type="text" name="newrole" /> 
	</p>
	<p>
		New Worktime: <input type="text" name="newroktime" /> 
	</p>
	<p>
		<input type="submit" value="Edit Employee" />
	</p>
</form>

</body>
</html>
