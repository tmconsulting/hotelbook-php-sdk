<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 27.04.16
 * Project: provider
 */

declare(strict_types=1);

namespace App\Hotelbook\Object\Hotel\Dictionary;


class City
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $countryId;

    /**
     * @var int
     */
    protected $hotelCount;

    /**
     * Есть ли аренда авто в этом городе (1)
     *
     * @var bool
     */
    protected $vehicleRent;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var float
     */
    protected $lat;

    /**
     * @var float
     */
    protected $lgn;

    /**
     * Область, в которой находится город.
     *
     * @var string
     */
    protected $region;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getCountryId()
    {
        return $this->countryId;
    }

    /**
     * @param int $countryId
     */
    public function setCountryId(int $countryId)
    {
        $this->countryId = $countryId;
    }

    /**
     * @return int
     */
    public function getHotelCount()
    {
        return $this->hotelCount;
    }

    /**
     * @param int $hotelCount
     */
    public function setHotelCount(int $hotelCount)
    {
        $this->hotelCount = $hotelCount;
    }

    /**
     * @return boolean
     */
    public function isVehicleRent()
    {
        return $this->vehicleRent;
    }

    /**
     * @param boolean $vehicleRent
     */
    public function setVehicleRent(bool $vehicleRent)
    {
        $this->vehicleRent = $vehicleRent;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param float $lat
     */
    public function setLat(float $lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return float
     */
    public function getLgn()
    {
        return $this->lgn;
    }

    /**
     * @param float $lgn
     */
    public function setLgn(float $lgn)
    {
        $this->lgn = $lgn;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $region
     */
    public function setRegion(string $region)
    {
        $this->region = $region;
    }
}