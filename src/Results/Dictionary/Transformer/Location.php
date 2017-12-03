<?php

namespace App\Hotelbook\Results\Dictionary\Transformer;

use App\Hotelbook\Object\Hotel\Dictionary\Location as LocationObject;
use App\Hotelbook\Results\TransformerInterface;

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
