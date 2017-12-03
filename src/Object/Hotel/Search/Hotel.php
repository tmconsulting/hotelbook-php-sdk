<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 28.04.16
 * Project: provider
 */

declare(strict_types=1);

namespace App\Hotelbook\Object\Hotel\Search;

use Money\Money;

/**
 * Class Hotel
 *
 * @package Hive\Common\Object\Hotel\SearchResult
 */
class Hotel
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $providerId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $stars;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var string
     */
    protected $description;

    /**
     * Доп. информация о предложении.
     * @var string
     */
    protected $info;

    /**
     * @var string
     */
    protected $image;

    /**
     * Расстояние до объекта в метрах.
     * Используется массив объектов new Distance('center', 4580)
     *
     * @var array
     */
    protected $locations;

    /**
     * @var float
     */
    protected $lat;

    /**
     * @var float
     */
    protected $lng;

    /**
     * @todo: Объект прайса должен быть не Money, а собственный, где собрано куча свойств к нему относящихся.
     * Внимание! Валюта указыватеся в объекте \Money\Money
     *
     * @var \Money\Money
     */
    protected $price;

    /**
     * @var int
     */
    protected $quota;

    /**
     * @return int
     */
    public function getQuota()
    {
        return $this->quota;
    }

    /**
     * @param int $quota
     * @return $this
     */
    public function setQuota(int $quota)
    {
        $this->quota = $quota;

        return $this;
    }

    /**
     * @return \Money\Money
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param \Money\Money $price
     * @return $this
     */
    public function setPrice(Money $price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
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
     * @return $this
     */
    public function setLat(float $lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * @return float
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @param float $lng
     * @return $this
     */
    public function setLng(float $lng)
    {
        $this->lng = $lng;

        return $this;
    }

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
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @param Location $location
     * @return $this
     */
    public function setLocation(Location $location)
    {
        $this->locations[] = $location;

        return $this;
    }

    /**
     * @return array
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * @param array $locations
     * @return $this
     */
    public function setLocations(array $locations)
    {
        $this->locations = $locations;

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
    public function setProviderId(int $providerId)
    {
        $this->providerId = $providerId;

        return $this;
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
     * @return int
     */
    public function getStars()
    {
        return $this->stars;
    }

    /**
     * @param int $stars
     */
    public function setStars(int $stars)
    {
        $this->stars = $stars;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param string $info
     */
    public function setInfo(string $info)
    {
        $this->info = $info;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return $this
     */
    public function setImage(string $image)
    {
        $this->image = $image;

        return $this;
    }
}
