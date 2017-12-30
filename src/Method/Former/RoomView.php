<?php

namespace Hotelbook\Method\Former;

/**
 * Class RoomView
 * @package App\Hotelbook\Method\Former
 */
class RoomView extends BaseFormer
{
    /**
     * @param $response
     * @return array
     */
    public function form($response)
    {
        $result = [];

        foreach ($response->RoomViews->RoomView as $roomView) {
            $result[] = [
                'id' => (int)$roomView->attributes()['id'],
                'name' => (string)$roomView->attributes()['name']
            ];
        }

        return $result;
    }
}