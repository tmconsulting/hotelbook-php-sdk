<?php

declare(strict_types=1);

namespace Hotelbook\Method\Former;

/**
 * Class Search
 * @package App\Hotelbook\Method\Former
 */
class Search extends BaseFormer
{
    /**
     * @param $response
     * @return array
     */
    public function form($response)
    {
        $searchRooms = $this->proceedRequest($response);
        return $this->proceedHotels($response, $searchRooms);
    }

    /**
     * @param $response
     * @return array
     */
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

    /**
     * @param $response
     * @param $searchRooms
     * @return array
     */
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
                'confirmation' => (string)$value['confirmation'],
                'coords' => [
                    'lat' => (float) array_get($value, 'hotelLatitude'),
                    'lng' => (float) array_get($value, 'hotelLongitude'),
                ],
                'price' => [
                    'sum' => $money->getAmount(),
                    'currency' => $money->getCurrency(),
                    'vat' => to_bool(array_get($value, 'useNds')),
                    'vatPrice' => (float) array_get($value, 'nds'),
                    'noOpenSale' => !to_bool(array_get($value, 'noOpenSale')),
                    'quotaAmount' => (string)array_get($value, 'quotaAmount'),
                    'rackRate' => $this->money((string)array_get($value, 'priceRackRate'), $value['currency'])->getAmount(),
                    'status' => (string) $value['priceStatus'],
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
}
