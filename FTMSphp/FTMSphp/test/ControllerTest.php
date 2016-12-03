<?php
require_once dirname(__DIR__).'/controller/Controller.php';
require_once dirname(__DIR__).'/controller/InputValidator.php';
require_once dirname(__DIR__).'/persistence\PersistenceFTMS.php';
require_once dirname(__DIR__).'/model\FoodTruckManager.php';
require_once dirname(__DIR__).'/model\Ingredient.php';
require_once dirname(__DIR__).'/model\Food.php';
require_once dirname(__DIR__).'/model\Employee.php';
require_once dirname(__DIR__).'/model\Equipment.php';

class ControllerTest extends PHPUnit_Framework_TestCase
{
	protected $c;
	protected $pm;
	protected $rm;
//rm is FoodTruckManager
	protected function setUp()
	{
		$this->c = new Controller();
		$this->pm = new PersistenceFTMS();
		$this->rm = $this->pm->loadDataFromStore();
		$this->rm->delete();
		$this->pm->writeDataToStore($this->rm);
	}

	protected function tearDown()
	{
	}

	public function testCreateIngredient() {
		$this->assertEquals(0, count($this->rm->getIngredients()));

		$name = "Banana";
		$quantity = 3;

		try {
			$this->c->createIngredient($name, $quantity);
		} catch (Exception $e) {
			// check that no error occurred
			$this->fail();
		}

		// check file contents
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(1, count($this->rm->getIngredients()));
		$this->assertEquals($name, $this->rm->getIngredient_index(0)->getName());
		$this->assertEquals($quantity, $this->rm->getIngredient_index(0)->getQuantity());
		$this->assertEquals(0, count($this->rm->getFoods()));
		$this->assertEquals(0, count($this->rm->getFoods()));
		$this->assertEquals(0, count($this->rm->getEmployees()));
	}
	
	public function testCreateIngredientNull() {
		$this->assertEquals(0, count($this->rm->getIngredients()));
	
		$name = null;
		$quantity = 3;
	
		$error = "";
		try {
			$this->c->createIngredient($name,$quantity);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	
		// check error
		$this->assertEquals("Name: Ingredient name cannot be empty!", $error);
		// check file contents
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(0, count($this->rm->getIngredients()));
		$this->assertEquals(0, count($this->rm->getEquipment()));
		$this->assertEquals(0, count($this->rm->getFoods()));
		$this->assertEquals(0, count($this->rm->getEmployees()));
	}
	
	public function testCreateIngredientSpaces() {
		$this->assertEquals(0, count($this->rm->getIngredients()));
	
		$name = " ";
		$quantity = 1;
	
		$error = "";
		try {
			$this->c->createIngredient($name,$quantity);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	
			// check error
		$this->assertEquals("Name: Ingredient name cannot be empty!", $error);
		// check file contents
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(0, count($this->rm->getIngredients()));
		$this->assertEquals(0, count($this->rm->getEquipment()));
		$this->assertEquals(0, count($this->rm->getFoods()));
		$this->assertEquals(0, count($this->rm->getEmployees()));
	}
	
	public function testEditIngredient() {
	$this->assertEquals(0, count($this->rm->getIngredients()));

		$name = "Banana";
		$quantity = 3;

		try {
			$this->c->createIngredient($name, $quantity);
		} catch (Exception $e) {
			// check that no error occurred
			$this->fail();
		}

		// check file contents
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(1, count($this->rm->getIngredients()));
		$this->assertEquals($name, $this->rm->getIngredient_index(0)->getName());
		$this->assertEquals($quantity, $this->rm->getIngredient_index(0)->getQuantity());
		
		try {
			$this->c->editingredient(0, "Apple", 4);
		} catch (Exception $e) {
			// check that no error occurred
			$this->fail();
		}
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(1, count($this->rm->getIngredients()));
		$this->assertEquals("Apple", $this->rm->getIngredient_index(0)->getName());
		$this->assertEquals(4, $this->rm->getIngredient_index(0)->getQuantity());		
	}
	
	public function testRemoveIngredient() {
		$this->assertEquals(0, count($this->rm->getIngredients()));
		$name = "Banana";
		$quantity = 3;
	
		try {
			$this->c->createIngredient($name, $quantity);
		} catch (Exception $e) {
			// check that no error occurred
			$this->fail();
		}
	
		// check file contents
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(1, count($this->rm->getIngredients()));
		$this->assertEquals($name, $this->rm->getIngredient_index(0)->getName());
		$this->assertEquals($quantity, $this->rm->getIngredient_index(0)->getQuantity());
	
		try {
			$this->c->removeingredient(0);
		} catch (Exception $e) {
			// check that no error occurred
			$this->fail();
		}
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(0, count($this->rm->getIngredients()));
		$this->assertEquals(0, count($this->rm->getEquipment()));
		$this->assertEquals(0, count($this->rm->getFoods()));
		$this->assertEquals(0, count($this->rm->getEmployees()));
	}
	
	public function testCreateEquipment() {
		$this->assertEquals(0, count($this->rm->getEquipment()));
	
		$name = "Frige";
		$quantity = 3;
	
		try {
			$this->c->createEquipment($name, $quantity);
		} catch (Exception $e) {
			// check that no error occurred
			$this->fail();
		}
	
		// check file contents
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(1, count($this->rm->getEquipment()));
		$this->assertEquals($name, $this->rm->getEquipment_index(0)->getName());
		$this->assertEquals($quantity, $this->rm->getEquipment_index(0)->getQuantity());
		$this->assertEquals(0, count($this->rm->getFoods()));
		$this->assertEquals(0, count($this->rm->getIngredients()));
		$this->assertEquals(0, count($this->rm->getEmployees()));
	}
	
	public function testCreateEquipmentNull() {
		$this->assertEquals(0, count($this->rm->getEquipment()));
	
		$name = null;
		$quantity = 3;
	
		$error = "";
		try {
			$this->c->createEquipment($name,$quantity);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	
		// check error
		$this->assertEquals("Name: Equipment name cannot be empty!", $error);
		// check file contents
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(0, count($this->rm->getIngredients()));
		$this->assertEquals(0, count($this->rm->getEquipment()));
		$this->assertEquals(0, count($this->rm->getFoods()));
		$this->assertEquals(0, count($this->rm->getEmployees()));
	}
	
	public function testCreateEquipmentSpaces() {
		$this->assertEquals(0, count($this->rm->getEquipment()));
	
		$name = " ";
		$quantity = 1;
	
		$error = "";
		try {
			$this->c->createEquipment($name,$quantity);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	
		// check error
		$this->assertEquals("Name: Equipment name cannot be empty!", $error);
		// check file contents
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(0, count($this->rm->getIngredients()));
		$this->assertEquals(0, count($this->rm->getEquipment()));
		$this->assertEquals(0, count($this->rm->getFoods()));
		$this->assertEquals(0, count($this->rm->getEmployees()));
	}
	
	public function testEditEquipment() {
		$this->assertEquals(0, count($this->rm->getEquipment()));
	
		$name = "Frige";
		$quantity = 3;
	
		try {
			$this->c->createEquipment($name, $quantity);
		} catch (Exception $e) {
			// check that no error occurred
			$this->fail();
		}
	
		// check file contents
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(1, count($this->rm->getEquipment()));
		$this->assertEquals($name, $this->rm->getEquipment_index(0)->getName());
		$this->assertEquals($quantity, $this->rm->getEquipment_index(0)->getQuantity());
	
		try {
			$this->c->editequipment(0, "Toaster", 4);
		} catch (Exception $e) {
			// check that no error occurred
			$this->fail();
		}
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(1, count($this->rm->getEquipment()));
		$this->assertEquals("Toaster", $this->rm->getEquipment_index(0)->getName());
		$this->assertEquals(4, $this->rm->getEquipment_index(0)->getQuantity());
	}
	
	public function testRemoveEquipment() {
		$this->assertEquals(0, count($this->rm->getEquipment()));
		$name = "Frige";
		$quantity = 3;
	
		try {
			$this->c->createEquipment($name, $quantity);
		} catch (Exception $e) {
			// check that no error occurred
			$this->fail();
		}
	
		// check file contents
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(1, count($this->rm->getEquipment()));
		$this->assertEquals($name, $this->rm->getEquipment_index(0)->getName());
		$this->assertEquals($quantity, $this->rm->getEquipment_index(0)->getQuantity());
	
		try {
			$this->c->removeequipment(0);
		} catch (Exception $e) {
			// check that no error occurred
			$this->fail();
		}
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(0, count($this->rm->getIngredients()));
		$this->assertEquals(0, count($this->rm->getEquipment()));
		$this->assertEquals(0, count($this->rm->getFoods()));
		$this->assertEquals(0, count($this->rm->getEmployees()));
	}
	
	public function testCreateFood() {
		$this->assertEquals(0, count($this->rm->getFoods()));
	
		$name = "hotdog";
		$price = 3;
	
		try {
			$this->c->createfood($name, $price);
		} catch (Exception $e) {
			// check that no error occurred
			$this->fail();
		}
	
		// check file contents
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(1, count($this->rm->getFoods()));
		$this->assertEquals($name, $this->rm->getFood_index(0)->getName());
		$this->assertEquals($price, $this->rm->getFood_index(0)->getPrice());
		$this->assertEquals(0, count($this->rm->getEquipment()));
		$this->assertEquals(0, count($this->rm->getIngredients()));
		$this->assertEquals(0, count($this->rm->getEmployees()));
	}
	
	public function testCreateFoodNull() {
		$this->assertEquals(0, count($this->rm->getFoods()));
	
		$name = null;
		$price = 3;
	
		$error = "";
		try {
			$this->c->createfood($name,$price);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	
		// check error
		$this->assertEquals("Name: Food name cannot be empty!", $error);
		// check file contents
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(0, count($this->rm->getIngredients()));
		$this->assertEquals(0, count($this->rm->getFoods()));
		$this->assertEquals(0, count($this->rm->getFoods()));
		$this->assertEquals(0, count($this->rm->getEmployees()));
	}
	
	public function testCreateFoodSpaces() {
		$this->assertEquals(0, count($this->rm->getFoods()));
	
		$name = " ";
		$price = 1;
	
		$error = "";
		try {
			$this->c->createfood($name,$price);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	
		// check error
		$this->assertEquals("Name: Food name cannot be empty!", $error);
		// check file contents
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(0, count($this->rm->getIngredients()));
		$this->assertEquals(0, count($this->rm->getFoods()));
		$this->assertEquals(0, count($this->rm->getFoods()));
		$this->assertEquals(0, count($this->rm->getEmployees()));
	}
	
	public function testEditFood() {
		$this->assertEquals(0, count($this->rm->getFoods()));
	
		$name = "Frige";
		$price = 3;
	
		try {
			$this->c->createfood($name, $price);
		} catch (Exception $e) {
			// check that no error occurred
			$this->fail();
		}
	
		// check file contents
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(1, count($this->rm->getFoods()));
		$this->assertEquals($name, $this->rm->getFood_index(0)->getName());
		$this->assertEquals($price, $this->rm->getFood_index(0)->getPrice());
	
		try {
			$this->c->editfood(0,"burger", 4, 1);
		} catch (Exception $e) {
			// check that no error occurred
			$this->fail();
		}
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(1, count($this->rm->getFoods()));
		$this->assertEquals("burger", $this->rm->getFood_index(0)->getName());
		$this->assertEquals(4, $this->rm->getFood_index(0)->getPrice());
	}
	
	public function testRemoveFood() {
		$this->assertEquals(0, count($this->rm->getFoods()));
		$name = "hotdog";
		$price = 3;
	
		try {
			$this->c->createfood($name, $price);
		} catch (Exception $e) {
			// check that no error occurred
			$this->fail();
		}
	
		// check file contents
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(1, count($this->rm->getFoods()));
		$this->assertEquals($name, $this->rm->getFood_index(0)->getName());
		$this->assertEquals($price, $this->rm->getFood_index(0)->getPrice());
	
		try {
			$this->c->removefood(0);
		} catch (Exception $e) {
			// check that no error occurred
			$this->fail();
		}
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(0, count($this->rm->getIngredients()));
		$this->assertEquals(0, count($this->rm->getFoods()));
		$this->assertEquals(0, count($this->rm->getEquipment()));
		$this->assertEquals(0, count($this->rm->getEmployees()));
	}
	
	public function testAddOrder(){
			$this->assertEquals(0, count($this->rm->getFoods()));
		$name = "hotdog";
		$price = 3;
	
		try {
			$this->c->createfood($name, $price);
		} catch (Exception $e) {
			// check that no error occurred
			$this->fail();
		}
	
		// check file contents
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(1, count($this->rm->getFoods()));
		$this->assertEquals($name, $this->rm->getFood_index(0)->getName());
		$this->assertEquals($price, $this->rm->getFood_index(0)->getPrice());
	
		try {
			$this->c->addorder($name, 5);
		} catch (Exception $e) {
			// check that no error occurred
			$this->fail();
		}
		
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(1, count($this->rm->getFoods()));
		$this->assertEquals($name, $this->rm->getFood_index(0)->getName());
		$this->assertEquals($price, $this->rm->getFood_index(0)->getPrice());
		$this->assertEquals(5, $this->rm->getFood_index(0)->getTotalOrdered());
		try {
			$this->c->addorder($name, 4);
		} catch (Exception $e) {
			// check that no error occurred
			$this->fail();
		}
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(9, $this->rm->getFood_index(0)->getTotalOrdered());
	}
	
	public function testCreateEmployee() {
		$this->assertEquals(0, count($this->rm->getEmployees()));
	
		$name = "Mike";
		$role = "chef";
		$worktime = "Mon.0800-1700";
	
		try {
			$this->c->createemployee($name, $role, $worktime);
		} catch (Exception $e) {
			// check that no error occurred
			$this->fail();
		}
	
		// check file contents
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(1, count($this->rm->getEmployees()));
		$this->assertEquals($name, $this->rm->getEmployee_index(0)->getName());
		$this->assertEquals($role, $this->rm->getEmployee_index(0)->getRole());
		$this->assertEquals($worktime, $this->rm->getEmployee_index(0)->getWorktime());
		$this->assertEquals(0, count($this->rm->getFoods()));
		$this->assertEquals(0, count($this->rm->getIngredients()));
		
	}
	
	public function testCreateEmployeeNull() {
		$this->assertEquals(0, count($this->rm->getEmployees()));
	
		$name = "";
		$role = "chef";
		$worktime = "Mon.0800-1700";
	
		$error = "";
		try {
			$this->c->createemployee($name,$role, $worktime);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	
		// check error
		$this->assertEquals("Name: Employee name cannot be empty!", $error);
		// check file contents
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(0, count($this->rm->getIngredients()));
		$this->assertEquals(0, count($this->rm->getEquipment()));
		$this->assertEquals(0, count($this->rm->getFoods()));
		$this->assertEquals(0, count($this->rm->getEmployees()));
	}
	
	public function testCreateEmployeeSpaces() {
		$this->assertEquals(0, count($this->rm->getEmployees()));
	
		$name = " ";
		$role = "chef";
		$worktime = "Mon.0800-1700";
	
		$error = "";
		try {
			$this->c->createemployee($name,$role, $worktime);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	
		// check error
		$this->assertEquals("Name: Employee name cannot be empty!", $error);
		// check file contents
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(0, count($this->rm->getIngredients()));
		$this->assertEquals(0, count($this->rm->getEquipment()));
		$this->assertEquals(0, count($this->rm->getFoods()));
		$this->assertEquals(0, count($this->rm->getEmployees()));
	}
	
	public function testEditEmployee() {
		$this->assertEquals(0, count($this->rm->getEmployees()));
	
		$name = "Mike";
		$role = "chef";
		$worktime = "Mon.0800-1700";
	
		try {
			$this->c->createemployee($name, $role, $worktime);
		} catch (Exception $e) {
			// check that no error occurred
			$this->fail();
		}
	
		// check file contents
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(1, count($this->rm->getEmployees()));
		$this->assertEquals($name, $this->rm->getEmployee_index(0)->getName());
		$this->assertEquals($role, $this->rm->getEmployee_index(0)->getRole());
	
		try {
			$this->c->editemployee(0, "Tom", "Cashier","TUE.0930-1830");
		} catch (Exception $e) {
			// check that no error occurred
			$this->fail();
		}
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(1, count($this->rm->getEmployees()));
		$this->assertEquals("Tom", $this->rm->getEmployee_index(0)->getName());
		$this->assertEquals("Cashier", $this->rm->getEmployee_index(0)->getRole());
		$this->assertEquals("TUE.0930-1830", $this->rm->getEmployee_index(0)->getWorktime());
	}
	
	public function testRemoveEmployee() {
		$this->assertEquals(0, count($this->rm->getEmployees()));
		$name = "Mike";
		$role = "chef";
		$worktime = "Mon.0800-1700";
	
		try {
			$this->c->createemployee($name, $role, $worktime);
		} catch (Exception $e) {
			// check that no error occurred
			$this->fail();
		}
	
		// check file contents
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(1, count($this->rm->getEmployees()));
		$this->assertEquals($name, $this->rm->getEmployee_index(0)->getName());
		$this->assertEquals($role, $this->rm->getEmployee_index(0)->getRole());
	
		try {
			$this->c->removeemployee(0);
		} catch (Exception $e) {
			// check that no error occurred
			$this->fail();
		}
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(0, count($this->rm->getIngredients()));
		$this->assertEquals(0, count($this->rm->getEquipment()));
		$this->assertEquals(0, count($this->rm->getFoods()));
		$this->assertEquals(0, count($this->rm->getEmployees()));
	}
	
	public function testCreateEmployeeWorkEndTimeBeforeWorkStartTime() {
		$this->assertEquals(0, count($this->rm->getEmployees()));
		$name = "Mike";
		$role = "chef";
		$worktime = "Mon.1700-0800";
		$error = "";
		try {
			$this->c->createemployee($name, $role, $worktime);
		} catch (Exception $e) {
			// check that no error occurred
			$error = $e->getMessage();
		}
		$this->assertEquals("@5 endtime cannot be earlier than starttime", $error);
		// check file contents
		$this->rm = $this->pm->loadDataFromStore();
		$this->assertEquals(0, count($this->rm->getIngredients()));
		$this->assertEquals(0, count($this->rm->getEquipment()));
		$this->assertEquals(0, count($this->rm->getFoods()));
		$this->assertEquals(0, count($this->rm->getEmployees()));
		
	}
	
}