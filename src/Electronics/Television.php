<?php

namespace src\Electronics;

class Television extends ElectronicItem
{
    private $maxExtras = -1;

    public function __construct()
    {
        /**
         * define the type of the electronic item
         */
        $this->setType(parent::ELECTRONIC_ITEM_TELEVISION);
    }

    public function maxExtras() : int
    {
        /**
         * return maximum extras
         */
        return $this->maxExtras;
    }
}