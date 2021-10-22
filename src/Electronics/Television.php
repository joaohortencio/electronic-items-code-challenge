<?php

namespace App\Electronics;

class Television extends ElectronicItem
{
    private $maxExtras = -1;

    public function __construct(float $price = 0 )
    {
        /**
         * define the type of the electronic item
         */
        $this->setType(parent::ELECTRONIC_ITEM_TELEVISION);

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