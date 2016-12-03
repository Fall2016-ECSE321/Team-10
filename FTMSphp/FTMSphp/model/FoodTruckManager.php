<?php 
/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.24.0-fcfceb9 modeling language!*/
 
class FoodTruckManager
{
 
  //------------------------
  // STATIC VARIABLES
  //------------------------
 
  private static $theInstance = null;
 
  //------------------------
  // MEMBER VARIABLES
  //------------------------
 
  //FoodTruckManager Associations
  private $foods;
  private $employees;
  private $equipment;
  private $ingredients;
  private $controllers;
 
  //------------------------
  // CONSTRUCTOR
  //------------------------
 
  private function __construct()
  {
    $this->foods = array();
    $this->employees = array();
    $this->equipment = array();
    $this->ingredients = array();
    $this->controllers = array();
  }
 
  public static function getInstance()
  {
    if(self::$theInstance == null)
    {
      self::$theInstance = new FoodTruckManager();
    }
    return self::$theInstance;
  }
 
  //------------------------
  // INTERFACE
  //------------------------
 
  public function getFood_index($index)
  {
    $aFood = $this->foods[$index];
    return $aFood;
  }
 
  public function getFoods()
  {
    $newFoods = $this->foods;
    return $newFoods;
  }
 
  public function numberOfFoods()
  {
    $number = count($this->foods);
    return $number;
  }
 
  public function hasFoods()
  {
    $has = $this->numberOfFoods() > 0;
    return $has;
  }
 
  public function indexOfFood($aFood)
  {
    $wasFound = false;
    $index = 0;
    foreach($this->foods as $food)
    {
      if ($food->equals($aFood))
      {
        $wasFound = true;
        break;
      }
      $index += 1;
    }
    $index = $wasFound ? $index : -1;
    return $index;
  }
 
  public function getEmployee_index($index)
  {
    $aEmployee = $this->employees[$index];
    return $aEmployee;
  }
 
  public function getEmployees()
  {
    $newEmployees = $this->employees;
    return $newEmployees;
  }
 
  public function numberOfEmployees()
  {
    $number = count($this->employees);
    return $number;
  }
 
  public function hasEmployees()
  {
    $has = $this->numberOfEmployees() > 0;
    return $has;
  }
 
  public function indexOfEmployee($aEmployee)
  {
    $wasFound = false;
    $index = 0;
    foreach($this->employees as $employee)
    {
      if ($employee->equals($aEmployee))
      {
        $wasFound = true;
        break;
      }
      $index += 1;
    }
    $index = $wasFound ? $index : -1;
    return $index;
  }
 
  public function getEquipment_index($index)
  {
    $aEquipment = $this->equipment[$index];
    return $aEquipment;
  }
 
  public function getEquipment()
  {
    $newEquipment = $this->equipment;
    return $newEquipment;
  }
 
  public function numberOfEquipment()
  {
    $number = count($this->equipment);
    return $number;
  }
 
  public function hasEquipment()
  {
    $has = $this->numberOfEquipment() > 0;
    return $has;
  }
 
  public function indexOfEquipment($aEquipment)
  {
    $wasFound = false;
    $index = 0;
    foreach($this->equipment as $equipment)
    {
      if ($equipment->equals($aEquipment))
      {
        $wasFound = true;
        break;
      }
      $index += 1;
    }
    $index = $wasFound ? $index : -1;
    return $index;
  }
 
  public function getIngredient_index($index)
  {
    $aIngredient = $this->ingredients[$index];
    return $aIngredient;
  }
 
  public function getIngredients()
  {
    $newIngredients = $this->ingredients;
    return $newIngredients;
  }
 
  public function numberOfIngredients()
  {
    $number = count($this->ingredients);
    return $number;
  }
 
  public function hasIngredients()
  {
    $has = $this->numberOfIngredients() > 0;
    return $has;
  }
 
  public function indexOfIngredient($aIngredient)
  {
    $wasFound = false;
    $index = 0;
    foreach($this->ingredients as $ingredient)
    {
      if ($ingredient->equals($aIngredient))
      {
        $wasFound = true;
        break;
      }
      $index += 1;
    }
    $index = $wasFound ? $index : -1;
    return $index;
  }
 
  public function getController_index($index)
  {
    $aController = $this->controllers[$index];
    return $aController;
  }
 
  public function getControllers()
  {
    $newControllers = $this->controllers;
    return $newControllers;
  }
 
  public function numberOfControllers()
  {
    $number = count($this->controllers);
    return $number;
  }
 
  public function hasControllers()
  {
    $has = $this->numberOfControllers() > 0;
    return $has;
  }
 
  public function indexOfController($aController)
  {
    $wasFound = false;
    $index = 0;
    foreach($this->controllers as $controller)
    {
      if ($controller->equals($aController))
      {
        $wasFound = true;
        break;
      }
      $index += 1;
    }
    $index = $wasFound ? $index : -1;
    return $index;
  }
 
  public static function minimumNumberOfFoods()
  {
    return 0;
  }
 
  public function addFood($aFood)
  {
    $wasAdded = false;
    if ($this->indexOfFood($aFood) !== -1) { return false; }
    $this->foods[] = $aFood;
    $wasAdded = true;
    return $wasAdded;
  }
 
  public function removeFood($aFood)
  {
    $wasRemoved = false;
    if ($this->indexOfFood($aFood) != -1)
    {
      unset($this->foods[$this->indexOfFood($aFood)]);
      $this->foods = array_values($this->foods);
      $wasRemoved = true;
    }
    return $wasRemoved;
  }
 
  public function addFoodAt($aFood, $index)
  {  
    $wasAdded = false;
    if($this->addFood($aFood))
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfFoods()) { $index = $this->numberOfFoods() - 1; }
      array_splice($this->foods, $this->indexOfFood($aFood), 1);
      array_splice($this->foods, $index, 0, array($aFood));
      $wasAdded = true;
    }
    return $wasAdded;
  }
 
  public function addOrMoveFoodAt($aFood, $index)
  {
    $wasAdded = false;
    if($this->indexOfFood($aFood) !== -1)
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfFoods()) { $index = $this->numberOfFoods() - 1; }
      array_splice($this->foods, $this->indexOfFood($aFood), 1);
      array_splice($this->foods, $index, 0, array($aFood));
      $wasAdded = true;
    } 
    else
    {
      $wasAdded = $this->addFoodAt($aFood, $index);
    }
    return $wasAdded;
  }
 
  public static function minimumNumberOfEmployees()
  {
    return 0;
  }
 
  public function addEmployee($aEmployee)
  {
    $wasAdded = false;
    if ($this->indexOfEmployee($aEmployee) !== -1) { return false; }
    $this->employees[] = $aEmployee;
    $wasAdded = true;
    return $wasAdded;
  }
 
  public function removeEmployee($aEmployee)
  {
    $wasRemoved = false;
    if ($this->indexOfEmployee($aEmployee) != -1)
    {
      unset($this->employees[$this->indexOfEmployee($aEmployee)]);
      $this->employees = array_values($this->employees);
      $wasRemoved = true;
    }
    return $wasRemoved;
  }
 
  public function addEmployeeAt($aEmployee, $index)
  {  
    $wasAdded = false;
    if($this->addEmployee($aEmployee))
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfEmployees()) { $index = $this->numberOfEmployees() - 1; }
      array_splice($this->employees, $this->indexOfEmployee($aEmployee), 1);
      array_splice($this->employees, $index, 0, array($aEmployee));
      $wasAdded = true;
    }
    return $wasAdded;
  }
 
  public function addOrMoveEmployeeAt($aEmployee, $index)
  {
    $wasAdded = false;
    if($this->indexOfEmployee($aEmployee) !== -1)
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfEmployees()) { $index = $this->numberOfEmployees() - 1; }
      array_splice($this->employees, $this->indexOfEmployee($aEmployee), 1);
      array_splice($this->employees, $index, 0, array($aEmployee));
      $wasAdded = true;
    } 
    else
    {
      $wasAdded = $this->addEmployeeAt($aEmployee, $index);
    }
    return $wasAdded;
  }
 
  public static function minimumNumberOfEquipment()
  {
    return 0;
  }
 
  public function addEquipment($aEquipment)
  {
    $wasAdded = false;
    if ($this->indexOfEquipment($aEquipment) !== -1) { return false; }
    $this->equipment[] = $aEquipment;
    $wasAdded = true;
    return $wasAdded;
  }
 
  public function removeEquipment($aEquipment)
  {
    $wasRemoved = false;
    if ($this->indexOfEquipment($aEquipment) != -1)
    {
      unset($this->equipment[$this->indexOfEquipment($aEquipment)]);
      $this->equipment = array_values($this->equipment);
      $wasRemoved = true;
    }
    return $wasRemoved;
  }
 
  public function addEquipmentAt($aEquipment, $index)
  {  
    $wasAdded = false;
    if($this->addEquipment($aEquipment))
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfEquipment()) { $index = $this->numberOfEquipment() - 1; }
      array_splice($this->equipment, $this->indexOfEquipment($aEquipment), 1);
      array_splice($this->equipment, $index, 0, array($aEquipment));
      $wasAdded = true;
    }
    return $wasAdded;
  }
 
  public function addOrMoveEquipmentAt($aEquipment, $index)
  {
    $wasAdded = false;
    if($this->indexOfEquipment($aEquipment) !== -1)
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfEquipment()) { $index = $this->numberOfEquipment() - 1; }
      array_splice($this->equipment, $this->indexOfEquipment($aEquipment), 1);
      array_splice($this->equipment, $index, 0, array($aEquipment));
      $wasAdded = true;
    } 
    else
    {
      $wasAdded = $this->addEquipmentAt($aEquipment, $index);
    }
    return $wasAdded;
  }
 
  public static function minimumNumberOfIngredients()
  {
    return 0;
  }
 
  public function addIngredient($aIngredient)
  {
    $wasAdded = false;
    if ($this->indexOfIngredient($aIngredient) !== -1) { return false; }
    $this->ingredients[] = $aIngredient;
    $wasAdded = true;
    return $wasAdded;
  }
 
  public function removeIngredient($aIngredient)
  {
    $wasRemoved = false;
    if ($this->indexOfIngredient($aIngredient) != -1)
    {
      unset($this->ingredients[$this->indexOfIngredient($aIngredient)]);
      $this->ingredients = array_values($this->ingredients);
      $wasRemoved = true;
    }
    return $wasRemoved;
  }
 
  public function addIngredientAt($aIngredient, $index)
  {  
    $wasAdded = false;
    if($this->addIngredient($aIngredient))
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfIngredients()) { $index = $this->numberOfIngredients() - 1; }
      array_splice($this->ingredients, $this->indexOfIngredient($aIngredient), 1);
      array_splice($this->ingredients, $index, 0, array($aIngredient));
      $wasAdded = true;
    }
    return $wasAdded;
  }
 
  public function addOrMoveIngredientAt($aIngredient, $index)
  {
    $wasAdded = false;
    if($this->indexOfIngredient($aIngredient) !== -1)
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfIngredients()) { $index = $this->numberOfIngredients() - 1; }
      array_splice($this->ingredients, $this->indexOfIngredient($aIngredient), 1);
      array_splice($this->ingredients, $index, 0, array($aIngredient));
      $wasAdded = true;
    } 
    else
    {
      $wasAdded = $this->addIngredientAt($aIngredient, $index);
    }
    return $wasAdded;
  }
 
  public static function minimumNumberOfControllers()
  {
    return 0;
  }
 
  public function addController($aController)
  {
    $wasAdded = false;
    if ($this->indexOfController($aController) !== -1) { return false; }
    $this->controllers[] = $aController;
    $wasAdded = true;
    return $wasAdded;
  }
 
  public function removeController($aController)
  {
    $wasRemoved = false;
    if ($this->indexOfController($aController) != -1)
    {
      unset($this->controllers[$this->indexOfController($aController)]);
      $this->controllers = array_values($this->controllers);
      $wasRemoved = true;
    }
    return $wasRemoved;
  }
 
  public function addControllerAt($aController, $index)
  {  
    $wasAdded = false;
    if($this->addController($aController))
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfControllers()) { $index = $this->numberOfControllers() - 1; }
      array_splice($this->controllers, $this->indexOfController($aController), 1);
      array_splice($this->controllers, $index, 0, array($aController));
      $wasAdded = true;
    }
    return $wasAdded;
  }
 
  public function addOrMoveControllerAt($aController, $index)
  {
    $wasAdded = false;
    if($this->indexOfController($aController) !== -1)
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfControllers()) { $index = $this->numberOfControllers() - 1; }
      array_splice($this->controllers, $this->indexOfController($aController), 1);
      array_splice($this->controllers, $index, 0, array($aController));
      $wasAdded = true;
    } 
    else
    {
      $wasAdded = $this->addControllerAt($aController, $index);
    }
    return $wasAdded;
  }
 
  public function equals($compareTo)
  {
    return $this == $compareTo;
  }
 
  public function delete()
  {
    $this->foods = array();
    $this->employees = array();
    $this->equipment = array();
    $this->ingredients = array();
    $this->controllers = array();
  }
 
}
 
?>
 
 
