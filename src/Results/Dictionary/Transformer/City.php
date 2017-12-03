<?php

namespace App\Hotelbook\Results\Dictionary\Transformer;

use App\Hotelbook\Object\Hotel\Dictionary\City as CityObject;
use App\Hotelbook\Results\TransformerInterface;

class City implements TransformerInterface
{
    public function transform(array $items)
    {
        return array_map(function ($item) {
            return new CityObject(
                $item['id'],
                $item['countryId'],
                $item['hotelCount'],
                (bool)$item['vehicleRent'],
                $item['name'],
                $item['lat'],
                $item['lgn']
            );
        }, $items);
    }
}
