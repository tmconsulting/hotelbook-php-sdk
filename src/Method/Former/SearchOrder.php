<?php

declare(strict_types=1);

namespace Hotelbook\Method\Former;

use Carbon\Carbon;

/**
 * Class SearchOrder
 * @package Hotelbook\Method\Former
 */
class SearchOrder extends BaseFormer
{
    /**
     * @param $response
     * @return array|mixed
     */
    public function form($response)
    {
        $result = [];
        $list = object_get($response, 'OrderList.Orders', []);

        foreach (object_get($list, 'Order', []) as $order) {
            $attributes = current($order);
            $result[] = [
                'orderId' => (int) array_get($attributes, 'id'),
                'orderState' => (string) array_get($attributes, 'state'),
                'xmlGate' => (string) array_get($attributes, 'via_xml_gate'),
                'tag' => (string) array_get($attributes, 'tag'),
                'hotelItem' => $this->prepareHotelItem($order)
            ];
        }

        return $result;
    }

    /**
     * @param $order
     * @return array
     */
    protected function prepareHotelItem($order)
    {
        $hotelItem = object_get($order, 'HotelItem');
        $attributes = current($hotelItem);

        return [
            'itemId' => (int) array_get($attributes, 'id'),
            'itemState' => (string) array_get($attributes, 'state'),
            'hotelId' => (int) object_get($hotelItem, 'HotelId'),
            'checkIn' => (string) object_get($hotelItem, 'CheckIn'),
            'checkOut' => $this->prepareCheckOut($hotelItem),
            'created' => (string) object_get($hotelItem, 'Created')
        ];
    }

    protected function prepareCheckOut($hotelItem)
    {
        $checkIn = (string) object_get($hotelItem, 'CheckIn');
        $duration = (int) object_get($hotelItem, 'Duration');

        return Carbon::parse($checkIn)->addDays($duration)->toDateString();
    }
}
