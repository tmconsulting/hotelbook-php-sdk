<?php

declare(strict_types=1);

namespace Hotelbook\Method\Former;

/**
 * Class Order
 * @package App\Hotelbook\Method\Former
 */
class Order extends BaseFormer
{
    public function form($response)
    {
        $order = $this->getOrder($response);
        return [
            'info' => $this->formOrderInfo($order),
            'paxes' => $this->formOrderPaxes($order),
            'contactInfo' => $this->formContactInfo($order),
            'items' => $this->formHotelItems($order)
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    protected function getOrder($response)
    {
        return $response->Order;
    }

    /**
     * @codeCoverageIgnore
     */
    protected function formOrderInfo($order)
    {
        return [
            'orderId' => (int)object_get($order, 'Id'),
            'manager' => (string)object_get($order, 'Manager'),
            'tag' => (int)object_get($order, 'Tag'),
            'orderUserId' => (int)object_get($order, 'OrderUserId'),
            'orderUserName' => (string)object_get($order, 'OrderUserName'),
            'state' => (string)object_get($order, 'State'),
            'creationDate' => (string)object_get($order, 'CreationDate'),
            'payFrom' => (string)object_get($order, 'PayForm'),
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    protected function formOrderPaxes($order)
    {
        $paxes = [];

        foreach ($order->Paxes->Pax as $pax) {
            $paxes[] = [
                'paxId' => (int)$pax->attributes()['paxId'],
                'child' => (string)$pax->attributes()['false'],
                'title' => (string)$pax->Title,
                'firstName' => (string)$pax->FirstName,
                'lastName' => (string)$pax->LastName,
            ];
        }

        return $paxes;
    }

    /**
     * @codeCoverageIgnore
     */
    protected function formContactInfo($order)
    {
        $contactInfo = $order->ContactInfo;

        if ($contactInfo !== null) {
            return [
                'name' => (string)object_get($contactInfo, 'Name'),
                'email' => (string)object_get($contactInfo, 'Email'),
                'phone' => (string)object_get($contactInfo, 'Phone'),
                'comment' => (string)object_get($contactInfo, 'Comment'),
            ];
        }

        return [];
    }

    /**
     * @codeCoverageIgnore
     */
    protected function formHotelItems($order)
    {
        $array = [];

        foreach ($order->Items->HotelItem as $hotelItem) {
            $money = $this->money((string)$hotelItem->TotalPrice, (string)$hotelItem->Currency);

            $hotelItemFormed = [
                'itemId' => (int)$hotelItem->attributes()['itemId'],
                'dynamicInventory' => (string)$hotelItem->attributes()['dynamicInventory'],
                'hotelId' => (int)$hotelItem->HotelId,
                'cityId' => (int)$hotelItem->CityId,
                'name' => (string)$hotelItem->Name,
                'categoryId' => (int)$hotelItem->CategoryId,
                'state' => (string)$hotelItem->State,
                'confirmation' => (string)$hotelItem->Confirmation,
                'checkIn' => (string)$hotelItem->CheckIn,
                'duration' => (string)$hotelItem->Duration,
                'price' => [
                    'sum' => $money->getAmount(),
                    'currency' => $money->getCurrency(),
                ],
                'providerId' => (int)$hotelItem->ProviderId,
            ];

            $rooms = [];

            foreach ($hotelItem->Rooms->Room as $room) {
                $roomAttributes = $room->attributes();
                $formedRoom = [
                    'roomId' => (int)array_get($roomAttributes, 'roomId'),
                    'roomSizeId' => (int)array_get($roomAttributes, 'roomSizeId'),
                    'roomSizeName' => (string)array_get($roomAttributes, 'roomSizeName'),
                    'roomTypeId' => (int)array_get($roomAttributes, 'roomTypeId'),
                    'roomTypeName' => (string)array_get($roomAttributes, 'roomTypeName'),
                    'roomViewId' => (int)array_get($roomAttributes, 'roomViewId'),
                    'roomName' => (string)array_get($roomAttributes, 'roomName'),
                    'mealId' => (int)array_get($roomAttributes, 'mealId'),
                    'mealName' => (string)array_get($roomAttributes, 'mealName'),
                    'child' => (string)array_get($roomAttributes, 'child'),
                    'cots' => (string)array_get($roomAttributes, 'cots'),
                    'sharingBedding' => (string)array_get($roomAttributes, 'sharingBedding'),
                ];

                $paxes = [];

                foreach ($room->Paxes->PaxId as $paxId) {
                    $paxes[] = [
                        'paxId' => (int)$paxId
                    ];
                }

                $formedRoom['paxes'] = $paxes;

                $rooms[] = $formedRoom;
            }

            $hotelItemFormed['rooms'] = $rooms;

            $array[] = $hotelItemFormed;
        }

        return $array;
    }
}
