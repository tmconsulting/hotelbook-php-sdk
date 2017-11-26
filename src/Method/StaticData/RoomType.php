<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\StaticData;

use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Object\Results\StaticData\RoomTypeResponse;

class RoomType extends AbstractMethod
{
    /**
     * @param $params
     * @return mixed
     */
    public function build($params)
    {
        return $params;
    }

    /**
     * @param $params
     * @return RoomTypeResponse
     */
    public function handle($params)
    {
        $result = $this->connector->request('GET', 'room_type', null, $params);
        [$values, $errors] = $this->performResult($result);
        return new RoomTypeResponse($values, $errors);
    }

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
