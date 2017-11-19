<?php

namespace App\Hotelbook;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Method\StaticData\City;
use App\Hotelbook\Method\DynamicResolver;
use App\Hotelbook\Method\StaticData\Country;
use App\Hotelbook\Object\Hotel\Dictionary\Country as CountryModel;

class StaticData {
    use DynamicResolver;

    /**
     * StaticData constructor.
     * @param ConnectorInterface $connector
     */
    public function __construct(ConnectorInterface $connector)
    {
        $this->setMethods($connector);
    }

    private function setMethods($connector)
    {
        $this->setMethod('country', new Country($connector));
        $this->setMethod('city', new City($connector));
    }

    /**
     * @param CountryModel|null $country
     * @return mixed
     */
    public function city(CountryModel $country = null)
    {
        return $this->callMethod('city', [$country]);
    }

    /**
     * Get Countries
     */
    public function country()
    {
        return $this->callMethod('country');
    }

}