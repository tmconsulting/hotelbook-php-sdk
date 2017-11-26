<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\StaticData;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Object\Results\StaticData\RoomTypeResponse;

class RoomType extends AbstractMethod
{
    private $connector;

    /**
     * RoomType constructor.
     * @param ConnectorInterface $connector
     */
    public function __construct(ConnectorInterface $connector)
    {
        $this->connector = $connector;
    }

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
        file_put_contents('room-type-response.xml', $result->asXML());
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
