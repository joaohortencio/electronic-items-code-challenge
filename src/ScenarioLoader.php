<?php

namespace App;

use App\Electronics\ElectronicItems;
use App\Electronics\Console;
use App\Electronics\Controller;
use App\Electronics\Microwave;
use App\Electronics\Television;
use Symfony\Component\Yaml\Yaml;

class scenarioLoader
{
    private $filePath;

    /**
     * @param $filePath Yaml File Path
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function load(): ElectronicItems
    {
        $yaml = Yaml::parseFile($this->filePath);
        $items = array();

        foreach ($yaml as $object => $configs) {
            $items[] = $this->loadElectronicItem($configs);
        }

        return new ElectronicItems($items);
    }

    private function loadElectronicItem(array $itemConfigs)
    {
        $item = $this->createElectronicItem($itemConfigs['type']);
        $item->setPrice($itemConfigs['price']);

        if( !empty($itemConfigs['wired']) )
        {
            $item->setWired($itemConfigs['wired']);
        }

        $extras = array();

        if (!empty($itemConfigs['extras'])) {
            foreach ($itemConfigs['extras'] as $extrasConfigs) {
                $extras[] = $this->loadElectronicItem($extrasConfigs);
            }
        }

        if(!empty($extras))
        {
            try{
                $item->setExtras(new ElectronicItems($extras));
            } catch (\Exception $e) {
                throw new \Exception("Error loading Scenario. Error Message: {$e->getMessage()}");
            }
        }

        return $item;
    }

    private function createElectronicItem($type)
    {
        $item = null;
        switch ($type){
            case 'console':
                $item = new Console();
                break;
            case 'controller':
                $item = new Controller();
                break;
            case 'television':
                $item = new Television();
                break;
            case 'microwave':
                $item = new Microwave();
                break;
            default:
                throw new \Exception('Unknown electronic type');
        }

        return $item;
    }

}