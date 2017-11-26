<?php

namespace App\Hotelbook\Object\Results\StaticData\Transformer;

use App\Hotelbook\Object\Results\TransformerInterface;
use App\Hotelbook\Object\Hotel\Dictionary\Location as LocationObject;

class Location implements TransformerInterface
{
    public function transform(array $items)
    {
        return array_map(function ($item) {
            return new LocationObject(
                $item['id'],
                $item['title'],
                $item['cityId'],
                $item['isGlobal']
            );
        }, $items);
    }
}
