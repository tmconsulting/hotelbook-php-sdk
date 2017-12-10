<?php

namespace App\Hotelbook\Method\Former;

/**
 * Class HotelList
 * @package App\Hotelbook\Method\Former
 */
class HotelList extends BaseFormer
{
    /**
     * @param $response
     * @return array
     */
    public function form($response)
    {
        $result = [];

        foreach ($response->HotelList->Hotel as $hotel) {
            $hotel = current($hotel);
            $result[] = [
                'id' => (int)$hotel['id'],
                'name' => (string)$hotel['name'],
                'name_ru' => (string)$hotel['name_ru'],
                'name_ru' => (string)$hotel['name_ru'],
                'city' => (int)$hotel['city'],
                'date_created' => (int)$hotel['date_create'],
                'date_updated' => (int)$hotel['updated'],
            ];
        }

        return $result;
    }
}