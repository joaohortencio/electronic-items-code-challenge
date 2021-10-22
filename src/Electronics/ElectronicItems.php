<?php
namespace App\Electronics;

class ElectronicItems
{
    private $items = array();

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Returns the items depending on the sorting type requested
     * @param int $type
     * @param int $sort_order
     * @return array
     * @throws \Exception
     */
    public function getSortedItems(int $type = SORT_NUMERIC, int $sort_order = SORT_DESC) : array
    {
        /*
         * checking if sorting type is valid
         */
        switch ($type)
        {
            case SORT_NUMERIC :
                break;
            case SORT_STRING:
                break;
            case SORT_REGULAR:
                break;
            case SORT_LOCALE_STRING:
                break;
            case SORT_NATURAL:
                break;
            case SORT_FLAG_CASE:
                break;
            default:
                throw new \Exception("Invalid sorting type declared: {$type}");
        }
        /**
         * checking if it has valid sort order
         */
        switch ($sort_order)
        {
            case SORT_DESC:
                break;
            case SORT_ASC:
                break;
            default:
                throw new \Exception("Invalid sort order: {$sort_order}");
        }

        /**
         * I've changed this sorting method because there was a logic error, if it has electronics with the same price,
         * it will be replaced on the sorted array, because it was using $sorted[$item->price*100]
         */
        $price = array();
        foreach ($this->items as $key=>$item)
        {
            $price[$key] = $item->price;
        }
        array_multisort($price, $sort_order, $type, $this->items);
        return $this->items;
    }
    /**
     *
     * @param string $type
     */
    public function getItemsByType(string $type = '')
    {
        if (in_array($type, ElectronicItem::getTypes()))
        {
            $callback = function($item) use ($type)
            {
                return $item->type == $type;
            };
            $items = array_filter($this->items, $callback);
        }
        return false;
    }
}