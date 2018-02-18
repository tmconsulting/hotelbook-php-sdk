<?php

declare(strict_types=1);

namespace Hotelbook\Method\Former;

/**
 * Class MoreDetails
 * @package Hotelbook\Method\Former
 */
class MoreDetails extends BaseFormer
{
    /**
     * @param $response
     * @return array|mixed
     */
    public function form($response)
    {
        $result = [];

        foreach ($response->HotelSearchDetails->Hotel as $hotel) {
            $result = $this->formHotel($hotel);
        }

        return $result;
    }

    /**
     * @param $hotel
     * @return array
     */
    protected function formHotel($hotel)
    {
        $attributes = current($hotel);

        return [
            'searchId' => array_get($attributes, 'searchId'),
            'resultId' => array_get($attributes, 'resultId'),
            'hotelId' => array_get($attributes, 'hotelId'),
            'providerId' => array_get($attributes, 'providerId'),
            'confirmation' => array_get($attributes, 'confirmation'),
            'earlestCheckInTime' => (string) object_get($hotel, 'EarlestCheckInTime'),
            'allowCheckInTime' => (bool) object_get($hotel, 'AllowCheckInTime'),
            'allowCheckOutTime' => (bool) object_get($hotel, 'AllowCheckOutTime'),
            'checkIn' => (string) object_get($hotel, 'CheckIn'),
            'duration' => (int) object_get($hotel, 'Duration'),
            'totalPrice' => (string) object_get($hotel, 'TotalPrice'),
            'currency' => (string) object_get($hotel, 'Currency'),
            'information' => (string) object_get($hotel, 'Information'),
            'noOpenSale' => (bool) object_get($hotel, 'NoOpenSale'),
            'visaMsk' => (bool) object_get($hotel, 'VisaMsk'),
            'visaSpb' => (bool) object_get($hotel, 'VisaSpb'),
            'useNds' => (bool) object_get($hotel, 'UseNds'),
            'commentLanguage' => (string) object_get($hotel, 'CommentLanguage'),

            'rooms' => $this->prepareRooms($hotel),
            'charge_conditions' => $this->prepareChargeConditions($hotel)
        ];
    }

    /**
     * @param $hotel
     * @return array
     */
    protected function prepareRooms($hotel)
    {
        $result = [];

        foreach ($hotel->Rooms->Room as $room) {
            $attributes = current($room);

            $result[] = [
                'roomSizeId' => (int)array_get($attributes, 'roomSizeId'),
                'roomSizeName' => (int)array_get($attributes, 'roomSizeName'),
                'roomTypeId' => (int)array_get($attributes, 'roomTypeId'),
                'roomTypeName' => (string)array_get($attributes, 'roomTypeName'),
                'roomViewId' => (int)array_get($attributes, 'roomViewId'),
                'roomViewName' => (string)array_get($attributes, 'roomViewName'),
                'roomName' => (string)array_get($attributes, 'roomName'),
                'roomNumber' => (int)array_get($attributes, 'roomNumber'),
                'mealId' => (int)array_get($attributes, 'mealId'),
                'mealName' => (string)array_get($attributes, 'mealName'),
                'child' => (int)array_get($attributes, 'child'),
                'cots' => (int)array_get($attributes, 'cots'),
                'sharingBedding' => (bool)array_get($attributes, 'sharingBedding'),
            ];
        }

        return $result;
    }

    /**
     * @param $hotel
     * @return array
     */
    protected function prepareChargeConditions($hotel)
    {
        $condition = $hotel->ChargeConditions;

        return [
            'currency' => (string) object_get($condition, 'Currency'),
            'denyNameChanges' => (bool)array_get(current(object_get($condition, 'DenyNameChanges')), 'deny'),
            'cancellations' => $this->prepareCancellations($condition),
            'amendments' => $this->prepareAmendments($condition)
        ];
    }

    /**
     * @param $condition
     * @return array
     */
    protected function prepareCancellations($condition)
    {
        $result = [];

        foreach ($condition->Cancellations->Cancellation as $cancellation) {
            $attributes = current($cancellation);

            $result[] = [
                'charge' => (bool) array_get($attributes, 'charge'),
                'denyChanges' => (bool) array_get($attributes, 'denyChanges'),
                'from' => (string) array_get($attributes, 'from'),
                'price' => (string) array_get($attributes, 'price'),
            ];
        }

        return $result;
    }

    /**
     * @param $condition
     * @return array
     */
    protected function prepareAmendments($condition)
    {
        $result = [];

        foreach ($condition->Amendments->Amendment as $amendment) {
            $attributes = current($amendment);

            $result[] = [
                'charge' => (bool) array_get($attributes, 'charge'),
                'denyChanges' => (bool) array_get($attributes, 'denyChanges'),
                'from' => (string) array_get($attributes, 'from'),
                'price' => (string) array_get($attributes, 'price'),
            ];
        }

        return $result;
    }
}
