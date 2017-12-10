<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\Former;

class Search extends BaseFormer
{
    protected function proceedRequest($response)
    {
        $searchRooms = [];

        foreach ($response->HotelSearchRequest->Rooms->Room as $room) {
            $attributes = current($room);

            $ages = [];
            foreach ($room->ChildAge as $age) {
                $ages[] = (string)$age;
            }

            $searchRooms[] = [
                'adults' => $attributes['adults'],
                'children' => isset($attributes['children']) ? $attributes['children'] : "0",
                'ages' => $ages
            ];
        }

        return $searchRooms;
    }

    protected function proceedHotels($response, $searchRooms)
    {
        $i = 0;
        $array = [];

        $search = current($response->HotelSearch);

        foreach ($response->Hotels->Hotel as $hotel) {
            if (!isset($hotel->Rooms->Room)) {
                continue;
            }

            $value = current($hotel);
            $money = $this->money($value['price'], $value['currency']);

            $array[] = [
                'searchId' => (string)$search['searchId'],
                'resultId' => (string)$value['resultId'],
                'hotelId' => (int)$value['hotelId'],
                'name' => (string)$value['hotelName'],
                'subProviderId' => (int)$value['providerId'],
                'address' => (string)$value['hotelAddress'],
                'stars' => (int)$value['hotelCatName'],
                'image' => (string)$value['hotelPhotoUrl'],
                'coords' => [
                    'lat' => isset($value['hotelLatitude']) ? (float)$value['hotelLatitude'] : null,
                    'lng' => isset($value['hotelLongitude']) ? (float)$value['hotelLongitude'] : null,
                ],
                'price' => [
                    'sum' => $money->getAmount(),
                    'currency' => $money->getCurrency(),
                    'vat' => to_bool(array_get($value, 'useNds')),
                    'noOpenSale' => !to_bool(array_get($value, 'noOpenSale')),
                    'quotaAmount' => $this->money((string)array_get($value, 'quotaAmount'), $value['currency'])->getAmount(),
                    'rackRate' => $this->money((string)array_get($value, 'priceRackRate'), $value['currency'])->getAmount(),
                ],
            ];

            foreach ($hotel->Rooms->Room as $room) {
                $room = current($room);
                $array[$i]['rooms'][] = [
                    'number' => (int)$room['roomNumber'],
                    'sizeId' => (int)$room['roomSizeId'],
                    'sizeName' => (string)$room['roomSizeName'],
                    'typeId' => (int)$room['roomTypeId'],
                    'typeName' => (string)$room['roomTypeName'],
                    'viewId' => (int)$room['roomViewId'],
                    'viewName' => (string)$room['roomViewName'],
                    'mealId' => (int)$room['mealId'],
                    'cots' => (int)$room['cots'],
                    'children' => (int)$room['children'],
                ];
            }

            $array[$i]['searchRooms'] = $searchRooms;

            $i++;
        }

        return $array;
    }

    public function form($response)
    {
        $searchRooms = $this->proceedRequest($response);
        return $this->proceedHotels($response, $searchRooms);
    }
}
