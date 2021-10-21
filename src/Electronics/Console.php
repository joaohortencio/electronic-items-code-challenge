<?php

namespace src\Electronics;

class Console extends ElectronicItem
{
    /**
     * @var int max quantity of extra items
     */
    private $maxExtras = 4;

    public function __construct()
    {
        /**
         * define the type of the electronic item
         */
        $this->setType(parent::ELECTRONIC_ITEM_CONSOLE);
    }

    public function maxExtras() : int
    {
        /**
         * return maximum extras
         */
        return $this->maxExtras;
    }
}