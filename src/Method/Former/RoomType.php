<?php

declare(strict_types=1);

namespace Hotelbook\Method\Former;

/**
 * Class RoomType
 * @package App\Hotelbook\Method\Former
 */
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
                'title' => (string)$roomType
            ];
        }

        return $items;
    }
}
