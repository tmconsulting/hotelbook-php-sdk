<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\Former\Dictionary;

use App\Hotelbook\Method\Former\BaseFormer;

class RoomAmenity extends BaseFormer
{
    /**
     * @param $response
     * @return array
     */
    public function form($response)
    {
        $items = [];

        foreach ($response->RoomAmenities->Amenity as $roomAmenity) {
            $items[] = [
                'id' => (int)$roomAmenity->attributes()['id'],
                'title' => (string)$roomAmenity
            ];
        }

        return $items;
    }
}
