<?php

namespace App\Hotelbook;

use App\Hotelbook\Object\Hotel\Dictionary\Country as CountryModel;

interface DictionaryInterface
{
    /**
     * Fetch all available countries.
     * @return mixed
     */
    public function country();

    /**
     * Fetch all available cities.
     * @param CountryModel|null $country
     * @return mixed
     */
    public function city(CountryModel $country = null);

    /**
     * Fetch all available locations.
     * @return mixed
     */
    public function location();

    /**
     * Fetch all available hotel types.
     * @return mixed
     */
    public function hotelType();

    /**
     * Fetch all available meal types.
     * @return mixed
     */
    public function meal();

    /**
     * Fetch all available room sizes.
     * @return mixed
     */
    public function roomSize();

    /**
     * Fetch all available room types.
     * @return mixed
     */
    public function roomType();

    /**
     * Fetch all available room amenities.
     * @return mixed
     */
    public function roomAmenity();
}
