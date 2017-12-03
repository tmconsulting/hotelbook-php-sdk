<?php

namespace App\Hotelbook\Results\Dictionary\Transformer;

use App\Hotelbook\Object\Hotel\Room\Type as RoomTypeObject;
use App\Hotelbook\Results\TransformerInterface;

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
