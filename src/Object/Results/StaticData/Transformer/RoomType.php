<?php

namespace App\Hotelbook\Object\Results\StaticData\Transformer;

use App\Hotelbook\Object\Results\TransformerInterface;
use App\Hotelbook\Object\Hotel\Room\Type as RoomTypeObject;

class RoomType implements TransformerInterface
{
    public function transform(array $items)
    {
        return array_map(function ($item) {
            return new RoomTypeObject(
                (int)$item['id'],
                (string)$item['name']
            );
        }, $items);
    }
}
