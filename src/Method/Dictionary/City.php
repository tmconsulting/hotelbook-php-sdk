<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\Dictionary;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Results\Dictionary\CityResponse;
use App\Hotelbook\Method\Builder\Dictionary\City as CityBuilder;
use App\Hotelbook\Method\Former\Dictionary\City as CityFormer;

/**
 * Dictionary - Get Cities method
 * Class City
 * @package App\Hotelbook\Method\Dictionary
 */
class City extends AbstractMethod
{
    /**
     * @var CityBuilder
     */
    protected $builder;

    /**
     * @var
     */
    protected $former;

    public function __construct(ConnectorInterface $connector)
    {
        parent::__construct($connector);

        $this->builder = new CityBuilder();
        $this->former = new CityFormer();
    }

    /**
     * @param $params
     * @return array
     */
    public function build($params)
    {
       return $this->builder->build($params);
    }

    /**
     * @param $params
     * @return CityResponse
     */
    public function handle($params)
    {
        $result = $this->connector->request('GET', 'cities', null, $params);
        return $this->getResultObject($result);
    }

    /**
     * @return string
     */
    protected function getResultClass()
    {
        return CityResponse::class;
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
