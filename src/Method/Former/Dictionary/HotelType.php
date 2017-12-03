<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\Former\Dictionary;

use App\Hotelbook\Method\Former\BaseFormer;

class HotelType extends BaseFormer
{
    /**
     * @param $response
     * @return array
     */
    public function form($response)
    {
        $items = [];

        foreach ($response->HotelTypes->Type as $hotelType) {
            $items[] = [
                'id' => (int)$hotelType->attributes()['id'],
                'title' => (string)$hotelType
            ];
        }

        return $items;
    }
}