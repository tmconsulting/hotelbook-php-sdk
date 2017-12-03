<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\Dictionary;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Method\Builder\BaseBuilder;
use App\Hotelbook\Method\Former\Dictionary\Location as LocationFormer;
use App\Hotelbook\Results\Dictionary\LocationResponse;

/**
 * A method to fetch all available Location
 * Class Location
 * @package App\Hotelbook\Method\Dictionary
 */
class Location extends AbstractMethod
{
    /**
     * @var BaseBuilder
     */
    protected $builder;
    /**
     * @var LocationFormer
     */
    protected $former;

    /**
     * Location constructor.
     * @param ConnectorInterface $connector
     */
    public function __construct(ConnectorInterface $connector)
    {
        parent::__construct($connector);

        $this->builder = new BaseBuilder();
        $this->former = new LocationFormer();
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
        $result = $this->connector->request('GET', 'location');
        return $this->getResultObject($result);
    }

    /**
     * @return string
     */
    protected function getResultClass()
    {
        return LocationResponse::class;
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
