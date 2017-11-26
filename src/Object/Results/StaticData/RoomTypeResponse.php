<?php

namespace App\Hotelbook\Object\Results\StaticData;

use App\Hotelbook\Object\Results\ResultProceeder;
use App\Hotelbook\Object\Hotel\Room\Type as RoomType;

class RoomTypeResponse extends ResultProceeder
{
    /**
     * RoomTypeResponse constructor.
     * @param array $items
     * @param array $errors
     */
    public function __construct(array $items, array $errors = [])
    {
        parent::__construct($items, $errors);

        $this->setItems($items);
    }

    /**
     * @param array $items
     * @return void
     */
    public function setItems(array $items)
    {
        $newItems = [];

        foreach ($items as $item)
        {
            $newItems[] = new RoomType((int)$item['id'], (string)$item['name']);
        }

        $this->items = $newItems;
    }
}