<?php

namespace App\Hotelbook\Object\Results\StaticData\Transformer;

use App\Hotelbook\Object\Hotel\Room\Amenity as RoomAmenityObject;
use App\Hotelbook\Object\Results\TransformerInterface;

class RoomAmenity implements TransformerInterface
{
    public function transform(array $items)
    {
        return array_map(function ($item) {
            return new RoomAmenityObject($item['id'], $item['title']);
        }, $items);
    }
}
