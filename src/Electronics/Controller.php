<?php

namespace App\Electronics;

class Controller extends ElectronicItem
{
    private $maxExtras = 0;

    public function __construct(float $price = 0)
    {
        /**
         * define the type of the electronic item
         */
        $this->setType(parent::ELECTRONIC_ITEM_CONTROLLER);

        $this->setPrice($price);
    }

    public function maxExtras() : int
    {
        /**
         * return maximum extras
         */
        return $this->maxExtras;
    }
}