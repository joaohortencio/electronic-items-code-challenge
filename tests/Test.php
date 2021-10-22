<?php

require './vendor/autoload.php';

use App\Electronics\Console;
use App\Electronics\Controller;
use App\Electronics\ElectronicItems;
use App\Electronics\Microwave;
use App\Electronics\ElectronicItem;
use App\Electronics\Television;
use App\ScenarioLoader;

use PHPUnit\Framework\TestCase;

class Test extends TestCase
{

    /**
     * MICROWAVE TESTS
     */
    public function testMicrowavePrice()
    {
        $electronic = new Microwave();
        $rdPrice = round(rand(1,999) / rand(2,3), 2);
        $electronic->setPrice($rdPrice);
        $this->assertSame($rdPrice, $electronic->getPrice());
    }

    public function testMicrowaveType()
    {
        $electronic = new Microwave();
        $this->assertSame(ElectronicItem::ELECTRONIC_ITEM_MICROWAVE, $electronic->getType());
    }

    public function testMicrowaveSetExtras() //can't have any extras
    {
        $electronic = new Microwave(round(rand(1,999) / rand(2,3), 2));
        $this->expectException(\Exception::class);
        $electronic->setExtras($this->createExtraElectronics(1));
    }

    /**
     * TELEVISION TESTS
     */
    public function testTelevisionPrice()
    {
        $electronic = new Television();
        $rdPrice = round(rand(1,999) / rand(2,3), 2);
        $electronic->setPrice($rdPrice);
        $this->assertSame($rdPrice, $electronic->getPrice());
    }

    public function testTelevisionType()
    {
        $electronic = new Television();
        $this->assertSame(ElectronicItem::ELECTRONIC_ITEM_TELEVISION, $electronic->getType());
    }

    public function testTelevisionSetExtras() //could have infinity extras
    {
        $electronic = new Television(round(rand(1,999) / rand(2,3), 2));

        $rdQtExtras = rand(0,50);
        $electronic->setExtras($this->createExtraElectronics($rdQtExtras));

        $this->assertSame( $rdQtExtras,count( $electronic->getExtras()->getSortedItems() ) );
    }

    /**
     * Console TESTS
     */
    public function testConsolePrice()
    {
        $electronic = new Console();
        $rdPrice = round(rand(1,999) / rand(2,3), 2);
        $electronic->setPrice($rdPrice);
        $this->assertSame($rdPrice, $electronic->getPrice());
    }

    public function testConsoleType()
    {
        $electronic = new Console();
        $this->assertSame(ElectronicItem::ELECTRONIC_ITEM_CONSOLE, $electronic->getType());
    }

    public function testConsoleSetExtras() //could have a maximum of 4 extras
    {
        $electronic = new Console(round(rand(1,999) / rand(2,3), 2));

        $rdQtExtras = rand(0,4);
        $electronic->setExtras($this->createExtraElectronics($rdQtExtras));

        $this->assertSame( $rdQtExtras,count( $electronic->getExtras()->getSortedItems() ) );
    }
    public function testConsoleSetExtrasMaximum() //could have a maximum of 4 extras
    {
        $electronic = new Console(round(rand(1,999) / rand(2,3), 2));
        $this->expectException(\Exception::class);
        $electronic->setExtras($this->createExtraElectronics(5));
    }


    /**
     * Controller TESTS
     */
    public function testControllerPrice()
    {
        $electronic = new Controller();
        $rdPrice = round(rand(1,999) / rand(2,3), 2);
        $electronic->setPrice($rdPrice);
        $this->assertSame($rdPrice, $electronic->getPrice());
    }

    public function testControllerType()
    {
        $electronic = new Controller();
        $this->assertSame(ElectronicItem::ELECTRONIC_ITEM_CONTROLLER, $electronic->getType());
    }

    public function testControllerSetExtras() //can't have any extras
    {
        $electronic = new Controller(round(rand(1,999) / rand(2,3), 2));
        $this->expectException(\Exception::class);
        $electronic->setExtras($this->createExtraElectronics(1));
    }


    public function testSortItems()
    {
        $scenario = new ScenarioLoader('src/scenarios/1.yaml');
        $items = $scenario->load();


        $sortedWithoutExtras = $items->getSortedItems(SORT_NUMERIC,SORT_DESC,false);
        $sortedWithExtras = $items->getSortedItems();

        $this->assertEquals(899.01, reset($sortedWithoutExtras)->getPrice() ); //check the first element
        $this->assertEquals(399.99, end($sortedWithoutExtras)->getPrice() ); //check the last element
        /**
         * because the item3 is a television with a price tag of 799, plus an extra controller with a price of 350
         * so it changed the sortItems results if you consider the prices of the extras
         */
        $this->assertEquals(799.0, reset($sortedWithExtras)->getPrice() ); //check the first element
        $this->assertEquals(399.99, end($sortedWithExtras)->getPrice() ); //check the last element


    }

    public function testGetItemsByType()
    {
        $scenario = new ScenarioLoader('src/scenarios/1.yaml');
        $items = $scenario->load();

        $television = $items->getItemsByType(ElectronicItem::ELECTRONIC_ITEM_TELEVISION);
        $console = $items->getItemsByType(ElectronicItem::ELECTRONIC_ITEM_CONSOLE);

        $this->assertCount(2, $television);
        $this->assertCount(1,$console );
    }

    public function testSingleElectronicTotalPrice()
    {
        $scenario = new ScenarioLoader('src/scenarios/1.yaml');
        $items = $scenario->load();
        $console = $items->getItemsByType(ElectronicItem::ELECTRONIC_ITEM_CONSOLE);
        $microwave = $items->getItemsByType(ElectronicItem::ELECTRONIC_ITEM_MICROWAVE);

        $this->assertEquals(759, reset($console)->getTotalPrice());
        $this->assertEquals(399.99, reset($microwave)->getTotalPrice());
    }

    public function testScenarioTotalPrice(){
        $scenario = new ScenarioLoader('src/scenarios/1.yaml');
        $items = $scenario->load();

        $this->assertEquals(3232, $items->getTotalPrice());
    }

    private function createExtraElectronics($count)
    {
        $extras = array();
        for ($i = 0; $i < $count; $i++) {
            $extras[] = new Controller( rand( 1,20 ) );
        }
        return new ElectronicItems($extras);
    }
}
