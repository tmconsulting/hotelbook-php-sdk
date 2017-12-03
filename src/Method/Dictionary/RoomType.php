<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\Dictionary;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Method\Builder\BaseBuilder;
use App\Hotelbook\Method\Former\Dictionary\RoomType as RoomTypeFormer;
use App\Hotelbook\Results\Dictionary\RoomTypeResponse;

/**
 * Class RoomType
 * @package App\Hotelbook\Method\Dictionary
 */
class RoomType extends AbstractMethod
{
    /**
     * @var BaseBuilder
     */
    protected $builder;
    /**
     * @var RoomTypeFormer
     */
    protected $former;

    /**
     * RoomType constructor.
     * @param ConnectorInterface $connector
     */
    public function __construct(ConnectorInterface $connector)
    {
        parent::__construct($connector);

        $this->builder = new BaseBuilder();
        $this->former = new RoomTypeFormer();
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
        $result = $this->connector->request('GET', 'room_type', null, $params);
        return $this->getResultObject($result);
    }

    /**
     * @return string
     */
    public function getResultClass()
    {
        return RoomTypeResponse::class;
    }

    /**
     * @param $response
     * @return array
     */
    public function form($response)
    {
        return $this->former->form($response);
    }
}
