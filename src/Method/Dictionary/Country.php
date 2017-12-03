<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\Dictionary;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Method\Builder\BaseBuilder;
use App\Hotelbook\Method\Former\Dictionary\Country as CountryFormer;
use App\Hotelbook\Results\Dictionary\CountryResponse;

/**
 * Dictionary method to fetch all available countries.
 * Class Country
 * @package App\Hotelbook\Method\Dictionary
 */
class Country extends AbstractMethod
{
    /**
     * @var BaseBuilder
     */
    protected $builder;

    /**
     * @var CountryFormer
     */
    protected $former;

    /**
     * Country constructor.
     * @param ConnectorInterface $connector
     */
    public function __construct(ConnectorInterface $connector)
    {
        parent::__construct($connector);

        $this->builder = new BaseBuilder();
        $this->former = new CountryFormer();
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
     * @return CountryResponse
     */
    public function handle($params)
    {
        $result = $this->connector->request('GET', 'countries');
        return $this->getResultObject($result);
    }

    /**
     * @return string
     */
    protected function getResultClass()
    {
        return CountryResponse::class;
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
