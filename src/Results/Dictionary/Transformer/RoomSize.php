<?php

namespace App\Hotelbook\Results\Dictionary\Transformer;

use App\Hotelbook\Object\Hotel\Room\Size as RoomSizeObject;
use App\Hotelbook\Results\TransformerInterface;

class RoomSize implements TransformerInterface
{
    public function transform(array $items)
    {
        return array_map(function ($roomSizeElement) {
            return new RoomSizeObject(
                $roomSizeElement['id'],
                $roomSizeElement['shortName'],
                $roomSizeElement['fullName'],
                $roomSizeElement['pax'],
                $roomSizeElement['children'],
                $roomSizeElement['cots'],
                $roomSizeElement['searchable']
            );
        }, $items);
    }
}
