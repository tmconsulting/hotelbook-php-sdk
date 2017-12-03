<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\Dictionary;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Method\Builder\BaseBuilder;
use App\Hotelbook\Method\Former\Dictionary\RoomAmenity as RoomAmenityFormer;
use App\Hotelbook\Results\Dictionary\RoomAmenityResponse;

/**
 * Class RoomAmenity
 * @package App\Hotelbook\Method\Dictionary
 */
class RoomAmenity extends AbstractMethod
{
    /**
     * @var BaseBuilder
     */
    protected $builder;
    /**
     * @var RoomAmenityFormer
     */
    protected $former;

    /**
     * RoomAmenity constructor.
     * @param ConnectorInterface $connector
     */
    public function __construct(ConnectorInterface $connector)
    {
        parent::__construct($connector);

        $this->builder = new BaseBuilder();
        $this->former = new RoomAmenityFormer();
    }

    /**
     * @param $params
     * @return mixed
     */
    public function build($params)
    {
        return $this->builder->build($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function handle($params)
    {
        $result = $this->connector->request('GET', 'room_amenity', null, $params);
        return $this->getResultObject($result);
    }

    /**
     * @return string
     */
    protected function getResultClass()
    {
        return RoomAmenityResponse::class;
    }

    /**
     * @param $response
     * @return array
     */
    protected function form($response)
    {
        return $this->former->form($response);
    }
}
