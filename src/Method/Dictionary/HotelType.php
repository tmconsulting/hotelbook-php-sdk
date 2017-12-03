<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\Dictionary;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Method\Builder\BaseBuilder;
use App\Hotelbook\Method\Former\Dictionary\HotelType as HotelTypeFormer;
use App\Hotelbook\Results\Dictionary\HotelTypeResponse;

/**
 * A method to fetch all available hotel types.
 * Class HotelType
 * @package App\Hotelbook\Method\Dictionary
 */
class HotelType extends AbstractMethod
{
    /**
     * @var BaseBuilder
     */
    protected $builder;
    /**
     * @var HotelTypeFormer
     */
    protected $former;

    /**
     * HotelType constructor.
     * @param ConnectorInterface $connector
     */
    public function __construct(ConnectorInterface $connector)
    {
        parent::__construct($connector);

        $this->builder = new BaseBuilder();
        $this->former = new HotelTypeFormer();
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
     * @return HotelTypeResponse
     */
    public function handle($params)
    {
        $results = $this->connector->request('GET', 'hotel_type');
        [$values, $errors] = $this->performResult($results);
        return new HotelTypeResponse($values, $errors);
    }

    /**
     * @return string
     * @codeCoverageIgnore
     */
    protected function getResultClass()
    {
        return HotelTypeResponse::class;
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
