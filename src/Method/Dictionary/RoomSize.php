<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\Dictionary;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Method\Builder\BaseBuilder;
use App\Hotelbook\Method\Former\Dictionary\RoomSize as RoomSizeFormer;
use App\Hotelbook\Results\Dictionary\RoomSizeResponse;

/**
 * A method to fetch all available hotel types.
 * Class RoomSize
 * @package App\Hotelbook\Method\Dictionary
 */
class RoomSize extends AbstractMethod
{
    /**
     * @var BaseBuilder
     */
    protected $builder;
    /**
     * @var RoomSizeFormer
     */
    protected $former;

    /**
     * RoomSize constructor.
     * @param ConnectorInterface $connector
     */
    public function __construct(ConnectorInterface $connector)
    {
        parent::__construct($connector);

        $this->builder = new BaseBuilder();
        $this->former = new RoomSizeFormer();
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
     * @return RoomTypeResponse
     */
    public function handle($params)
    {
        $result = $this->connector->request('GET', 'room_size', null, $params);
        return $this->getResultObject($result);
    }

    /**
     * @return string
     */
    protected function getResultClass()
    {
        return RoomSizeResponse::class;
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
