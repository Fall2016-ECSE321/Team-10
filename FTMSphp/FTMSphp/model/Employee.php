<?php 
/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.24.0-fcfceb9 modeling language!*/
 
class Employee
{
 
  //------------------------
  // STATIC VARIABLES
  //------------------------
 
  private static $nextId = 1;
 
  //------------------------
  // MEMBER VARIABLES
  //------------------------
 
  //Employee Attributes
  private $name;
  private $role;
  private $worktime;
 
  //Autounique Attributes
  private $id;
 
  //------------------------
  // CONSTRUCTOR
  //------------------------
 
  public function __construct($aName, $aRole, $aWorktime)
  {
    $this->name = $aName;
    $this->role = $aRole;
    $this->worktime = $aWorktime;
    $this->id = self::$nextId++;
  }
 
  //------------------------
  // INTERFACE
  //------------------------
 
  public function setName($aName)
  {
    $wasSet = false;
    $this->name = $aName;
    $wasSet = true;
    return $wasSet;
  }
 
  public function setRole($aRole)
  {
    $wasSet = false;
    $this->role = $aRole;
    $wasSet = true;
    return $wasSet;
  }
 
  public function setWorktime($aWorktime)
  {
    $wasSet = false;
    $this->worktime = $aWorktime;
    $wasSet = true;
    return $wasSet;
  }
 
  public function getName()
  {
    return $this->name;
  }
 
  public function getRole()
  {
    return $this->role;
  }
 
  public function getWorktime()
  {
    return $this->worktime;
  }
 
  public function getId()
  {
    return $this->id;
  }

  public function equals($compareTo)
  {
    return $this == $compareTo;
  }
 
  public function delete()
  {}
 
}
 
?>
 
 
