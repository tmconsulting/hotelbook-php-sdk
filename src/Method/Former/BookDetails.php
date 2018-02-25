<?php

declare(strict_types=1);

namespace Hotelbook\Method\Former;
use function GuzzleHttp\Psr7\str;

/**
 * Class BookDetails
 * @package Hotelbook\Method\Former
 */
class BookDetails extends BaseFormer
{
    /**
     * @param $response
     * @return array|mixed
     */
    public function form($response)
    {
        $order = $response->Order;

        return [
            'id' => (int)object_get($order, 'Id'),
            'manager' => (string)object_get($order, 'Manager'),
            'tag' => (string)object_get($order, 'Tag'),
            'orderUserId' => (string)object_get($order, 'OrderUserId'),
            'orderUserName' => (string)object_get($order, 'OrderUserName'),
            'state' => (string)object_get($order, 'State'),
            'creationDate' => (string)object_get($order, 'CreationDate'),
            'payForm' => (string)object_get($order, 'PayForm'),

            'pax' => $this->preparePax($order),
            'items' => $this->prepareItems($order),
            'contactInfo' => $this->prepareContactInfo($order),
            'messages' => $this->prepareMessages($order)
        ];
    }

    /**
     * @param $order
     * @return array
     */
    protected function preparePax($order)
    {
        $result = [];

        foreach ($order->Paxes->Pax as $pax) {
            $attributes = current($pax);

            $result[] = [
                'paxId' => (string)array_get($attributes, 'paxId'),
                'isLeader' => (string)array_get($attributes, 'isLeader'),
                'child' => (string)array_get($attributes, 'child'),
                'title' => (string)object_get($pax, 'Title'),
                'firstName' => (string)object_get($pax, 'FirstName'),
                'lastName' => (string)object_get($pax, 'LastName')
            ];
        }

        return $result;
    }

    /**
     * @param $order
     * @return array
     */
    protected function prepareItems($order)
    {
        $result = [];

        foreach ($order->Items->HotelItem as $hotelItem) {
            $attributes = current($hotelItem);

            $checkInObject = current(object_get($hotelItem, 'CheckInTime'));
            $checkOutObject = current(object_get($hotelItem, 'CheckOutTime'));

            $result[] = [
                'itemId' => array_get($attributes, 'itemId'),
                'dynamicInventory' => array_get($attributes, 'dynamicInventory'),
                'hotelId' => (int)object_get($hotelItem, 'HotelId'),
                'cityId' => (int)object_get($hotelItem, 'CityId'),
                'name' => (string)object_get($hotelItem, 'Name'),
                'categoryId' => (int)object_get($hotelItem, 'CategoryId'),
                'state' => (string)object_get($hotelItem, 'State'),
                'earlestCheckInTime' => (string)object_get($hotelItem, 'EarlestCheckInTime'),
                'latestCheckOutTime' => (string)object_get($hotelItem, 'LatestCheckOutTime'),
                'confirmation' => (string)object_get($hotelItem, 'Confirmation'),
                'checkIn' => (string)object_get($hotelItem, 'CheckIn'),
                'duration' => (int)object_get($hotelItem, 'Duration'),
                'totalPrice' => (string)object_get($hotelItem, 'TotalPrice'),
                'currency' => (string)object_get($hotelItem, 'currency'),
                'extraPrice' => (string)object_get($hotelItem, 'ExtraPrice'),
                'extraPriceCurrency' => (string)array_get(object_get($hotelItem, 'ExtraPrice')->attributes(), 'currency'),
                'checkInTime' => [
                    'info' => (string)array_get($checkInObject, 'info'),
                    'default' => (string)array_get($checkInObject, 'default'),
                    'value' => (string)array_get($checkInObject, 'value'),
                ],
                'checkOutTime' => [
                    'info' => (string)array_get($checkOutObject, 'info'),
                    'default' => (string)array_get($checkOutObject, 'default'),
                    'value' => (string)array_get($checkOutObject, 'value'),
                ],
                'nds' => (string)object_get($hotelItem, 'UseNds'),
                'providerId' => (string)object_get($hotelItem, 'ProviderId'),
                'providerReference' => (string)object_get($hotelItem, 'ProviderReference'),
                'possibleRemarks' => $this->preparePossibleRemarks($hotelItem),
                'commentLanguage' => (string)object_get($hotelItem, 'CommentLanguage'),
                'rooms' => $this->prepareRooms($hotelItem),
                'remarks' => $this->prepareRemarks($hotelItem),
                'chargeConditions' => $this->prepareChargeConditions($hotelItem),
                'priceDetails' => $this->preparePriceDetails($hotelItem)
            ];
        }

        return $result;
    }

    /**
     * @param $hotel
     * @return array
     */
    protected function prepareChargeConditions($order)
    {
        $condition = $order->ChargeConditions;

        return [
            'currency' => (string) object_get($condition, 'Currency'),
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

    /**
     * @param $order
     * @return array
     */
    protected function preparePriceDetails($order)
    {
        $priceDetails = object_get($order, 'PriceDetails');

        return [
            'currency' => (string) object_get($priceDetails, 'Currency'),
            'roomPrices' => $this->preparePriceDetailsRooms( object_get($priceDetails, 'RoomPrices') )
        ];
    }

    /**
     * @param $roomPrices
     * @return array
     */
    protected function preparePriceDetailsRooms($roomPrices)
    {
        $result = [];

        foreach ($roomPrices->Room as $room) {
            $attributes = current($room);

            $result[] = [
              'roomNumber' => (int) array_get($attributes, 'roomNumber'),
              'roomTypeId' => (int) array_get($attributes, 'roomTypeId'),
              'roomViewId' => (int) array_get($attributes, 'roomViewId'),
              'child' => (int) array_get($attributes, 'child'),
              'prices' => $this->preparePriceDetailsRoomPrices($room)
            ];
        }

        return $result;
    }

    /**
     * @param $room
     * @return array
     */
    protected function preparePriceDetailsRoomPrices($room)
    {
        $result = [];

        foreach ($room->Price as $price) {
            $attributes = current($price);

            $result[] = [
                'date' => (string) array_get($attributes, 'date'),
                'available' => (string) array_get($attributes, 'available'),
                'price' => (string) array_get($attributes, 'price'),
            ];
        }

        return $result;
    }

    /**
     * @param $order
     * @return array
     */
    protected function prepareRemarks($order)
    {
        $remarks = object_get($order, 'Remarks.Remark', []);
        $result = [];

        foreach ($remarks as $remark) {
            $result[] = (string)$remark;
        }

        return $result;
    }

    /**
     * @param $order
     * @return array
     */
    protected function preparePossibleRemarks($order)
    {
        $result = [];

        foreach ($order->PossibleRemarks->Remark as $remark) {
            $result[] = [
                'code' => array_get(current($remark), 'code')
            ];
        }

        return $result;
    }

    /**
     * @param $order
     * @return array
     */
    protected function prepareRooms($order)
    {
        foreach ($order->Rooms->Room as $room) {
            $attributes = current($room);

            $result[] = [
                'roomId' => (int)array_get($attributes, 'roomId'),
                'roomSizeId' => (int)array_get($attributes, 'roomSizeId'),
                'roomSizeName' => (string)array_get($attributes, 'roomSizeName'),
                'roomTypeId' => (int)array_get($attributes, 'roomTypeId'),
                'roomTypeName' => (string)array_get($attributes, 'roomTypeName'),
                'roomViewId' => (int)array_get($attributes, 'roomViewId'),
                'roomViewName' => (string)array_get($attributes, 'roomViewName'),
                'roomName' => (string)array_get($attributes, 'roomName'),
                'mealId' => (int)array_get($attributes, 'mealId'),
                'mealName' => (string)array_get($attributes, 'mealName'),
                'child' => (int)array_get($attributes, 'child'),
                'cots' => (int)array_get($attributes, 'cots'),
                'sharingBedding' => (string)array_get($attributes, 'sharingBedding'),
                'paxes' => $this->prepareRoomPax($room)
            ];
        }

        return $result;
    }

    /**
     * @param $room
     * @return array
     */
    protected function prepareRoomPax($room)
    {
        $result = [];

        foreach ($room->Paxes->PaxId as $paxId) {
            $result[] = (int)$paxId;
        }

        return $result;
    }


    /**
     * @param $order
     * @return array
     */
    protected function prepareContactInfo($order)
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

    protected function prepareMessages($order)
    {
        $messages = object_get($order, 'MessagesOnline.Message', []);
        $result = [];

        foreach ($messages as $message) {
            $result[] = [
                'id' => (int)  object_get($message, 'Id'),
                'type' => (string)  object_get($message, 'Type'),
                'message' => (string)  object_get($message, 'Message'),
                'direction' => (string)  object_get($message, 'Direction'),
                'isRead' => (string)  object_get($message, 'isRead'),
                'date' => (string)  object_get($message, 'Date'),
                'userName' => (string) object_get($message, 'User.Name'),
            ];
        }

        return $result;
    }
}

