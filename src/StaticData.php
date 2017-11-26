<?php

namespace App\Hotelbook;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Method\DynamicResolver;
use App\Hotelbook\Method\StaticData\City;
use App\Hotelbook\Method\StaticData\Country;
use App\Hotelbook\Method\StaticData\HotelType;
use App\Hotelbook\Method\StaticData\Location;
use App\Hotelbook\Method\StaticData\Meal;
use App\Hotelbook\Method\StaticData\RoomAmenity;
use App\Hotelbook\Method\StaticData\RoomSize;
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
        $this->setMethod('location', new Location($connector));

        //Hotel
        $this->setMethod('hotelType', new HotelType($connector));
        $this->setMethod('meal', new Meal($connector));

        //Rooms
        $this->setMethod('roomSize', new RoomSize($connector));
        $this->setMethod('roomType', new RoomType($connector));
        $this->setMethod('roomAmenity', new RoomAmenity($connector));
    }


    /**
     * Fetch all available countries.
     * @return mixed
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
     * Fetch all available locations.
     * @return mixed
     */
    public function location()
    {
        return $this->callMethod('location');
    }

    /**
     * Fetch all available hotel types.
     * @return mixed
     */
    public function hotelType()
    {
        return $this->callMethod('hotelType');
    }

    /**
     * Fetch all available meal types.
     * @return mixed
     */
    public function meal()
    {
        return $this->callMethod('meal');
    }

    /**
     * Fetch all available room sizes.
     * @return mixed
     */
    public function roomSize()
    {
        return $this->callMethod('roomSize');
    }

    /**
     * Fetch all available room types.
     * @return mixed
     */
    public function roomType()
    {
        return $this->callMethod('roomType');
    }

    /**
     * Fetch all available room amenities.
     * @return mixed
     */
    public function roomAmenity()
    {
        return $this->callMethod('roomAmenity');
    }
}
