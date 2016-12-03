<?php 
//%% NEW FILE Food BEGINS HERE %%


/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.24.0-c37463a modeling language!*/

class Food
{

  //------------------------
  // STATIC VARIABLES
  //------------------------

  private static $nextId = 1;

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Food Attributes
  private $name;
  private $price;
  private $totalOrdered;

  //Autounique Attributes
  private $id;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public function __construct($aName, $aPrice, $aTotalOrdered)
  {
    $this->name = $aName;
    $this->price = $aPrice;
    $this->totalOrdered = $aTotalOrdered;
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

  public function setPrice($aPrice)
  {
    $wasSet = false;
    $this->price = $aPrice;
    $wasSet = true;
    return $wasSet;
  }

  public function setTotalOrdered($aTotalOrdered)
  {
    $wasSet = false;
    $this->totalOrdered = $aTotalOrdered;
    $wasSet = true;
    return $wasSet;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getPrice()
  {
    return $this->price;
  }

  public function getTotalOrdered()
  {
    return $this->totalOrdered;
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