
<?php
require_once dirname(__DIR__).'/persistence\PersistenceFTMS.php';
require_once dirname(__DIR__).'/model\FoodTruckManager.php';
require_once dirname(__DIR__).'/model\Ingredient.php';

class PersistenceFTMSTest extends PHPUnit_Framework_TestCase
{
	protected $pm;

	protected function setUp()
	{
		$this->pm = new PersistenceFTMS();
	}

	protected function tearDown()
	{

	}

	public function testPersistence()
	{
		$rm = FoodTruckManager::getInstance();
		$ingredient = new Ingredient ( "Onion", 3 );
		$rm->addIngredient($ingredient);
		
		$this->pm->writeDataToStore($rm);

		$rm->delete();

		$this->assertEquals(0, count($rm->getIngredients()));

		$rm = $this->pm->loadDataFromStore();

		$this->assertEquals(1, count($rm->getIngredients()));
		$myIngredient = $rm->getIngredient_index(0);
		$this->assertEquals("Onion", $myIngredient->getName());
		$this->assertEquals(3, $myIngredient->getQuantity());
	}
}
?>