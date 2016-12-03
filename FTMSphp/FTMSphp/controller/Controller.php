<?php
require_once dirname ( __DIR__ ) . '/controller/InputValidator.php';
require_once dirname ( __DIR__ ) . '/model/FoodTruckManager.php';
require_once dirname ( __DIR__ ) . '/model/Food.php';
require_once dirname ( __DIR__ ) . '/model/Ingredient.php';
require_once dirname ( __DIR__ ) . '/model/Equipment.php';
require_once dirname ( __DIR__ ) . '/model/Employee.php';
require_once dirname ( __DIR__ ) . '/persistence/PersistenceFTMS.php';
class Controller {
	public function __construct() {
	}
	public function createfood($dishname, $dishprice) {
		$name = InputValidator::validate_input ( $dishname );
		
		if ($name == null || strlen ( $name ) == 0) {
			throw new Exception ( "Name: Food name cannot be empty!" );
		} else if (! is_numeric ( $dishprice )) {
			throw new Exception ( "Price: Food price must be a number" );
		} else if ($dishprice < 0) {
			throw new Exception ( "Price: Food price must be positive" );
		} else {
			
			$pm = new PersistenceFTMS ();
			$rm = $pm->loadDataFromStore ();
			
			$food = new Food ( $name, $dishprice, 0 );
			$rm->addFood ( $food );
			
			$pm->writeDataToStore ( $rm );
		}
	}
	public function removefood($index) {
		$pm = new PersistenceFTMS ();
		$rm = $pm->loadDataFromStore ();
		
		$food = $rm->getFood_index ( $index );
		$rm->removeFood ( $food );
		$pm->writeDataToStore ( $rm );
	}
	public function editfood($index, $newname, $newprice, $newordered) {
		$pm = new PersistenceFTMS ();
		$rm = $pm->loadDataFromStore ();
		
		if ($newname == null || strlen ( $newname ) == 0) {
			throw new Exception ( "Name: Food name cannot be empty!" );
		} else if (! is_numeric ( $newprice )) {
			throw new Exception ( "Price: Food price must be a number" );
		} else if ($newprice < 0) {
			throw new Exception ( "Price: Food price must be positive" );
		} else if (! is_numeric ( $newordered )) {
			throw new Exception ( "Order: Order quantitymust be a number" );
		} else if ($newordered < 0) {
			throw new Exception ( "Order: Order quantity must be positive" );
		} else {
			$food = $rm->getFood_index ( $index );
			$rm->removeFood ( $food );
			$pm->writeDataToStore ( $rm );
			$food = new Food ( $newname, $newprice, $newordered );
			$rm->addFoodAt ( $food, $index );
			$pm->writeDataToStore ( $rm );
		}
	}
	public function addorder($dishname, $dishordered) {
		$pm = new PersistenceFTMS ();
		$rm = $pm->loadDataFromStore ();
		foreach ( $rm->getFoods () as $food ) {
			if ($food->getName () == $dishname) {
				break;
			}
		}
		if ($newname == null || strlen ( $newname ) == 0) {
			throw new Exception ( "Name: Food name cannot be empty!" );
		} else if (! is_numeric ( $dishordered )) {
			throw new Exception ( "Number ordered: Order quantity must be a number" );
		} else if ($dishordered < 0) {
			throw new Exception ( "Number ordered: Order number must be positive" );
		} else {
			$oldorder = $food->getTotalOrdered ();
			$newtotalorder = $oldorder + $dishordered;
			$food->setTotalOrdered ( $newtotalorder );
			$pm->writeDataToStore ( $rm );
		}
	}
	public function createingredient($ingredientname, $quantity) {
		$name = InputValidator::validate_input ( $ingredientname );
		$quantity = InputValidator::validate_input ( $quantity );
		
		if ($name == null || strlen ( $name ) == 0) {
			throw new Exception ( "Name: Ingredient name cannot be empty!" );
		} else if (! is_numeric ( $quantity )) {
			throw new Exception ( "Quantity: Ingredient quantity must be a number" );
		} else if ($quantity < 0) {
			throw new Exception ( "Quantity: Ingredient quantity must be a positive number" );
		} else {
			
			$pm = new PersistenceFTMS ();
			$rm = $pm->loadDataFromStore ();
			
			$ingredient = new Ingredient ( $name, $quantity );
			$rm->addIngredient ( $ingredient );
			
			$pm->writeDataToStore ( $rm );
		}
	}
	public function removeingredient($index) {
		$pm = new PersistenceFTMS ();
		$rm = $pm->loadDataFromStore ();
		
		$ingredient = $rm->getIngredient_index ( $index );
		$rm->removeIngredient ( $ingredient );
		$pm->writeDataToStore ( $rm );
	}
	public function editingredient($index, $name, $quantity) {
		$pm = new PersistenceFTMS ();
		$rm = $pm->loadDataFromStore ();
		if ($name == null || strlen ( $name ) == 0) {
			throw new Exception ( "Name: Ingredient name cannot be empty!" );
		} else if (! is_numeric ( $quantity )) {
			throw new Exception ( "Quantity: Ingredient quantity must be a number" );
		} else if ($quantity < 0) {
			throw new Exception ( "Quantity: Ingredient quantity must be a positive number" );
		} else {
			$ingredient = $rm->getIngredient_index ( $index );
			$rm->removeIngredient ( $ingredient );
			$pm->writeDataToStore ( $rm );
			$ingredient = new Ingredient ( $name, $quantity );
			$rm->addIngredientAt ( $ingredient, $index );
			$pm->writeDataToStore ( $rm );
		}
	}
	public function createequipment($equipmentname, $quantity) {
		$name = InputValidator::validate_input ( $equipmentname );
		
		if ($name == null || strlen ( $name ) == 0) {
			throw new Exception ( "Name: Equipment name cannot be empty!" );
		} else if (! is_numeric ( $quantity )) {
			throw new Expcetion ( "Quantity: Equipment quantity must be a number" );
		} else if (! is_numeric ( $quantity ) || $quantity < 0) {
			throw new Exception ( "Quantity: Equipment quantity must be a positive number" );
		} else {
			$pm = new PersistenceFTMS ();
			$rm = $pm->loadDataFromStore ();
			
			$equipment = new Equipment ( $name, $quantity );
			$rm->addEquipment ( $equipment );
			
			$pm->writeDataToStore ( $rm );
		}
	}
	public function removeequipment($index) {
		$pm = new PersistenceFTMS ();
		$rm = $pm->loadDataFromStore ();
		
		$equipment = $rm->getEquipment_index ( $index );
		$rm->removeEquipment ( $equipment );
		$pm->writeDataToStore ( $rm );
	}
	public function editequipment($index, $name, $quantity) {
		$pm = new PersistenceFTMS ();
		$rm = $pm->loadDataFromStore ();
		if ($name == null || strlen ( $name ) == 0) {
			throw new Exception ( "Name: Equipment name cannot be empty!" );
		} else if (! is_numeric ( $quantity )) {
			throw new Expcetion ( "Quantity: Equipment quantity must be a number" );
		} else if ($quantity < 0) {
			throw new Exception ( "Quantity: Equipment quantity must be a positive number" );
		} else {
			$equipment = $rm->getEquipment_index ( $index );
			$rm->removeEquipment ( $equipment );
			$pm->writeDataToStore ( $rm );
			$equipment = new Equipment ( $name, $quantity );
			$rm->addEquipmentAt ( $equipment, $index );
			$pm->writeDataToStore ( $rm );
		}
	}
	public function createemployee($employeename, $role, $worktime) {
		$name = InputValidator::validate_input ( $employeename );
		$worktime = InputValidator::validate_input ( $worktime );
		$error = "";
		
		if ($name == null || strlen ( $name ) == 0) {
			throw new Exception ( "Name: Employee name cannot be empty!" );
		} else if ($role == null || strlen ( $role ) == 0 || is_numeric ( $role )) {
			throw new Exception ( "Role: Role cannot be empty" );
		} else if ($worktime == null || strlen ( $worktime ) == 0) {
			throw new Exception ( "Worktime: Worktime cannot be empty" );
		} else {
			$worktimes = explode ( ",", $worktime );
			foreach ( $worktimes as $eachworktime ) {
				if (strlen ( $eachworktime ) != 13 || ! strstr ( $eachworktime, "." ) || ! strstr ( $eachworktime, "-" )) {
					$error = $error . "@1 Work time format is incorrect! ";
				}
				
				$dayandhour = explode ( ".", $eachworktime );
				
				if (! strstr ( "MONTUEWEDTHUFRISATSUN", strtoupper ( $dayandhour [0] ) ))
					$error = $error . "@2 Wrong week day! " . $dayandhour [0];
				
				$hour = explode ( "-", $dayandhour [1] );
				if (! is_numeric ( $hour [0] ) || ! is_numeric ( $hour [1] ) || $hour [0] [2] > 6 || $hour [1] [2] > 6) {
					$error = $error . "@3 Wrong work time! ";
				}
				
				$starttime = intval ( $hour [0] );
				$endtime = intval ( $hour [1] );
				if ($starttime > 2400 || $endtime > 2400) {
					$error = $error . "@4 Work time doesn't exist! ";
				} else if ($starttime - $endtime > 0) {
					$error = $error . "@5 endtime cannot be earlier than starttime ";
				}
			}
			
			if (strlen ( $error ) > 0) {
				throw new Exception ( trim ( $error ) );
			} else {
				
				$pm = new PersistenceFTMS ();
				$rm = $pm->loadDataFromStore ();
				
				$employee = new Employee ( $name, $role, $worktime );
				$rm->addEmployee ( $employee );
				
				$pm->writeDataToStore ( $rm );
			}
		}
	}
	public function removeemployee($index) {
		$pm = new PersistenceFTMS ();
		$rm = $pm->loadDataFromStore ();
		
		$employee = $rm->getEmployee_index ( $index );
		$rm->removeEmployee ( $employee );
		$pm->writeDataToStore ( $rm );
	}
	public function editemployee($index, $name, $role, $newworktime) {
		$name = InputValidator::validate_input ( $name );
		$worktime = InputValidator::validate_input ( $newworktime );
		$error = "";
		
		if ($name == null || strlen ( $name ) == 0) {
			throw new Exception ( "Name: Employee name cannot be empty!" );
		} else if ($role == null || strlen ( $role ) == 0 || is_numeric ( $role )) {
			throw new Exception ( "Role: Role cannot be empty" );
		} else if ($worktime == null || strlen ( $worktime ) == 0) {
			throw new Exception ( "Worktime: Worktime cannot be empty" );
		} else {
			$worktimes = explode ( ",", $worktime );
			foreach ( $worktimes as $eachworktime ) {
				if (strlen ( $eachworktime ) != 13 || ! strstr ( $eachworktime, "." ) || ! strstr ( $eachworktime, "-" )) {
					$error = $error . "@1 Work time format is incorrect! " . $eachworktime . " ";
				}
				
				$dayandhour = explode ( ".", $eachworktime );
				
				if (! strstr ( "MONTUEWEDTHUFRISATSUN", strtoupper ( $dayandhour [0] ) ))
					$error = $error . "@2 Wrong week day! " . $dayandhour [0] . " ";
				
				$hour = explode ( "-", $dayandhour [1] );
				if (! is_numeric ( $hour [0] ) || ! is_numeric ( $hour [1] ) || $hour [0] [2] > 6 || $hour [0] [3] > 6 || $hour [1] [2] > 6 || $hour [1] [3] > 6) {
					$error = $error . "@3 Wrong work time! " . $hour [0] . " " . $hour [1] . " ";
				}
				
				$starttime = intval ( $hour [0] );
				$endtime = intval ( $hour [1] );
				if ($starttime > 2400 || $endtime > 2400) {
					$error = $error . "@4 Work time doesn't exist! ";
				} else if ($starttime - $endtime > 0) {
					$error = $error . "@5 endtime cannot be earlier than starttime ";
				}
			}
			
			if (strlen ( $error ) > 0) {
				throw new Exception ( trim ( $error ) );
			} else {
				
				$pm = new PersistenceFTMS ();
				$rm = $pm->loadDataFromStore ();
				
				$employee = $rm->getEmployee_index ( $index );
				$rm->removeEmployee ( $employee );
				$pm->writeDataToStore ( $rm );
				$employee = new Employee ( $name, $role, $newworktime );
				
				$rm->addEmployeeAt ( $employee, $index );
				$pm->writeDataToStore ( $rm );
			}
		}
	}
}
?>