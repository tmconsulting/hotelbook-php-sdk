<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 07.06.16
 * Project: provider
 */

declare(strict_types=1);

namespace App\Hotelbook\Object\Hotel;

/**
 * Class SearchParameter
 *
 * @package Hive\Common\Object\Hotel
 */
class SearchParameter
{
    /**
     * @var int
     */
    protected $cityId;

    /**
     * Идентификатор отеля, по которому выполнить поиск.
     *
     * @var int
     */
    protected $hotelId;

    /**
     * Идентификатор поставщика, по которому выполнить поиск.
     *
     * @var int
     */
    protected $providerId;

    /**
     * Место у которого искать.
     *
     * @var int
     */
    protected $locationId;

    /**
     * SearchParameter constructor.
     *
     * @param null $cityId
     * @param null $hotelId
     * @param null $providerId
     * @param null $locationId
     */
    public function __construct($cityId = null, $hotelId = null, $providerId = null, $locationId = null)
    {
        is_null($cityId) || $this->setCityId($cityId);
        is_null($hotelId) || $this->setHotelId($hotelId);
        is_null($providerId) || $this->setHotelId($providerId);
        is_null($locationId) || $this->setLocationId($locationId);
    }

    /**
     * @return int
     */
    public function getCityId()
    {
        return $this->cityId;
    }

    /**
     * @param int $cityId
     * @return $this
     */
    public function setCityId(?int $cityId)
    {
        $this->cityId = $cityId;

        return $this;
    }

    /**
     * @return int
     */
    public function getHotelId()
    {
        return $this->hotelId;
    }

    /**
     * @param int $hotelId
     * @return $this
     */
    public function setHotelId(?int $hotelId)
    {
        $this->hotelId = $hotelId;

        return $this;
    }

    /**
     * @return int
     */
    public function getLocationId()
    {
        return $this->locationId;
    }

    /**
     * @param int $locationId
     * @return SearchParameter
     */
    public function setLocationId(?int $locationId)
    {
        $this->locationId = $locationId;

        return $this;
    }

    /**
     * @return int
     */
    public function getProviderId()
    {
        return $this->providerId;
    }

    /**
     * @param int $providerId
     * @return $this
     */
    public function setProviderId(?int $providerId)
    {
        $this->providerId = $providerId;

        return $this;
    }
}
