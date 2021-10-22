<?php

namespace App\Electronics;

use phpDocumentor\Reflection\Types\Boolean;

abstract class ElectronicItem
{
    /**
     * @var float
     */
    public $price;
    /**
     * @var string
     */
    private $type;
    /**
     * @var bool
     */
    public $wired;
    private $extras;

    const ELECTRONIC_ITEM_TELEVISION = 'television';
    const ELECTRONIC_ITEM_CONSOLE = 'console';
    const ELECTRONIC_ITEM_MICROWAVE = 'microwave';
    const ELECTRONIC_ITEM_CONTROLLER = 'controller'; //included, was missing.
    private static $types = array
        (
            self::ELECTRONIC_ITEM_CONSOLE,
            self::ELECTRONIC_ITEM_MICROWAVE,
            self::ELECTRONIC_ITEM_TELEVISION,
            self::ELECTRONIC_ITEM_CONTROLLER
        );

    public static function getTypes(): array
    {
        return static::$types;
    }

    public function getPrice():float
    {
        return $this->price;
    }

    public function getType():string
    {
        return $this->type;
    }

    public function getWired():bool
    {
        return $this->wired;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setWired($wired)
    {
        $this->wired = $wired;
    }

    public function getTotalPrice() : float
    {
        $totalPrice = $this->getPrice();
        if(!empty($this->extras))
        {
            foreach ($this->extras->getSortedItems() as $extra) {
                $totalPrice += $extra->getTotalPrice(); //calculates recursively for extras items inside an extra item.
            }
        }

        return $totalPrice;
    }

    /**
     * Attach a list of electronic items to it
     * @param ElectronicItems $extras
     * @throws \Exception
     */
    public function setExtras(ElectronicItems $extras)
    {
        /**
         * If maxExtras() return < 0, it means there's no limit of extras, if it is >=0, checks if it already passed the limit
         * in a confirmed case of count() > maxExtras() throw exception.
         */
        if ($this->maxExtras() >= 0 && count($extras->getSortedItems()) > $this->maxExtras()) {
            throw new \Exception("The electronic item of type {$this->getType()} has max limit of {$this->maxExtras()} extra items");
        }

        $this->extras = $extras;
    }

    /**
     * Return an array containing n ElectronicItem objects
     * @return ElectronicItems
     */
    public function getExtras():ElectronicItems
    {
        return $this->extras;
    }

    abstract public function maxExtras() : int;
}