<?php

require './vendor/autoload.php';

use App\Electronics\Console;
use App\Electronics\Controller;
use App\Electronics\ElectronicItems;
use App\Electronics\Microwave;
use App\Electronics\ElectronicItem;
use App\Electronics\Television;

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




    private function createExtraElectronics($count)
    {
        $extras = array();
        for ($i = 0; $i < $count; $i++) {
            $extras[] = new Controller( rand( 1,20 ) );
        }
        return new ElectronicItems($extras);
    }
}
