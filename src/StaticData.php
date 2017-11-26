<?php

namespace App\Hotelbook;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Method\DynamicResolver;
use App\Hotelbook\Method\StaticData\City;
use App\Hotelbook\Method\StaticData\Country;
use App\Hotelbook\Method\StaticData\RoomType;
use App\Hotelbook\Object\Hotel\Dictionary\Country as CountryModel;

class StaticData
{
    use DynamicResolver;

    /**
     * This class is created for fetching the static data from the hotelbook API.
     * StaticData constructor.
     * @param ConnectorInterface $connector
     */
    public function __construct(ConnectorInterface $connector)
    {
        $this->setMethods($connector);
    }

    /**
     * @param $connector
     * @return void
     */
    private function setMethods($connector)
    {
        //Locations
        $this->setMethod('country', new Country($connector));
        $this->setMethod('city', new City($connector));

        //Hotel

        //Rooms
        $this->setMethod('roomType', new RoomType($connector));
    }


    /**
     * Fetch all available countries.
     * @return void
     */
    public function country()
    {
        return $this->callMethod('country');
    }

    /**
     * Fetch all available cities.
     * @param CountryModel|null $country
     * @return mixed
     */
    public function city(CountryModel $country = null)
    {
        return $this->callMethod('city', [$country]);
    }

    /**
     * Fetch all available room types.
     * @return mixed
     */
    public function roomType()
    {
        return $this->callMethod('roomType');
    }
}
