<?php

namespace App\Hotelbook\Object\Results\StaticData\Transformer;

use App\Hotelbook\Object\Results\TransformerInterface;
use App\Hotelbook\Object\Hotel\Type as HotelTypeObject;

class HotelType implements TransformerInterface
{
    public function transform(array $items)
    {
        return array_map(function ($item) {
            return new HotelTypeObject(
                $item['id'],
                $item['title']
            );
        }, $items);
    }
}
