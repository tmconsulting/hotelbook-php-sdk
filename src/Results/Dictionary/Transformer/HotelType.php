<?php

namespace App\Hotelbook\Results\Dictionary\Transformer;

use App\Hotelbook\Object\Hotel\Type as HotelTypeObject;
use App\Hotelbook\Results\TransformerInterface;

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
