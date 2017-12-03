<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\Former\Dictionary;

use App\Hotelbook\Method\Former\BaseFormer;

class RoomType extends BaseFormer
{
    /**
     * @param $response
     * @return array
     */
    public function form($response)
    {
        $items = [];

        foreach ($response->RoomTypes->RoomType as $roomType) {
            $items[] = [
                'id' => (int)$roomType->attributes()['id'],
                'name' => (string)$roomType
            ];
        }

        return $items;
    }
}
