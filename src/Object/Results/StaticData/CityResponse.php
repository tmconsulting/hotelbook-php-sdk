<?php

namespace App\Hotelbook\Object\Results\StaticData;

use App\Hotelbook\Object\Hotel\Dictionary\City;
use App\Hotelbook\Object\Results\ResultProceeder;

class CityResponse extends ResultProceeder
{
    public function __construct(array $items, array $errors = [])
    {
        parent::__construct($items, $errors);
        $this->setItems($items);
    }

    public function setItems(array $items)
    {
        $newItems = [];

        foreach ($items as $item) {
            $newItems[] = new City(
                $item['id'],
                $item['countryId'],
                $item['hotelCount'],
                (bool)$item['vehicleRent'],
                $item['name'],
                $item['lat'],
                $item['lgn']
            );
        }

        $this->items = $newItems;
    }
}