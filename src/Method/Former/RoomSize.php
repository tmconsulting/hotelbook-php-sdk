<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\Former;

class RoomSize extends BaseFormer
{
    /**
     * @param $response
     * @return array
     */
    public function form($response)
    {
        $items = [];

        foreach ($response->RoomSizes->RoomSize as $roomSize) {
            $items[] = [
                'id' => (int)$roomSize->attributes()['id'],
                'shortName' => (string)$roomSize->attributes()['name'],
                'pax' => (int)$roomSize->attributes()['pax'],
                'children' => (bool)$roomSize->attributes()['children'],
                'cots' => (int)$roomSize->attributes()['cots'],
                'searchable' => (bool)$roomSize->attributes()['search'],
                'fullName' => (string)$roomSize
            ];
        }

        return $items;
    }
}
