<?php

namespace App\Hotelbook\Object\Results\StaticData;

use App\Hotelbook\Object\Hotel\Dictionary\Country;
use App\Hotelbook\Object\Results\ResultProceeder;

class CountryResponse extends ResultProceeder
{
    public function __construct(array $items, array $errors = [])
    {
        parent::__construct($items, $errors);

        $this->setItems($items);
    }

    public function setItems(array $items)
    {
        $newItems = [];

        foreach ($this->items as &$item) {
            $newItems[] = new Country($item['id'], $item['name']);
        }

        $this->items = $newItems;
    }
}
