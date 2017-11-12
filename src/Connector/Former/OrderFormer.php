<?php

declare(strict_types=1);

namespace App\Hotelbook\Connector\Former;

class OrderFormer extends BaseFormer
{
    protected function formOrderInfo($order)
    {
        return [
            'orderId' => (int)$order->Id,
            'manager' => (string)$order->Manager,
            'tag' => (int)$order->Tag,
            'orderUserId' => (int)$order->OrderUserId,
            'orderUserName' => (string)$order->OrderUserName,
            'state' => (string)$order->State,
            'creationDate' => (string)$order->CreationDate,
            'payFrom' => (string)$order->PayForm
        ];
    }

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

    protected function formContactInfo($order)
    {
        $contactInfo = $order->ContactInfo;

        if ($contactInfo !== null) {
            return [
                'name' => (string)$contactInfo->Name,
                'email' => (string)$contactInfo->Email,
                'phone' => (string)$contactInfo->Phone,
                'comment' => (string)$contactInfo->Comment,
            ];
        }

        return [];
    }

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
                $formedRoom = [
                    'roomId' => (int)$room->attributes()['roomId'],
                    'roomSizeId' => (int)$room->attributes()['roomSizeId'],
                    'roomSizeName' => (string)$room->attributes()['roomSizeName'],
                    'roomTypeId' => (int)$room->attributes()['roomTypeId'],
                    'roomTypeName' => (string)$room->attributes()['roomTypeName'],
                    'roomViewId' => (int)$room->attributes()['roomViewId'],
                    'roomName' => (string)$room->attributes()['roomName'],
                    'mealId' => (int)$room->attributes()['mealId'],
                    'mealName' => (string)$room->attributes()['mealName'],
                    'child' => (string)$room->attributes()['child'],
                    'cots' => (string)$room->attributes()['cots'],
                    'sharingBedding' => (string)$room->attributes()['sharingBedding'],
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

    protected function getOrder($response)
    {
        return $response->Order;
    }

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
}
