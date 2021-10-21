<?php

namespace src\Electronics;

class Controller extends ElectronicItem
{
    private $maxExtras = 0;

    public function __construct()
    {
        /**
         * define the type of the electronic item
         */
        $this->setType(parent::ELECTRONIC_ITEM_CONTROLLER);
    }

    public function maxExtras() : int
    {
        /**
         * return maximum extras
         */
        return $this->maxExtras;
    }
}