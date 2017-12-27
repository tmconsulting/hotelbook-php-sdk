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

/**
 * Class Location
 *
 * The list of objects near the hotel.
 *
 * @package Hive\Common\Object\Hotel
 */
class Location
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $title;
    /**
     * @var int
     */
    protected $cityId;
    /**
     * @var bool
     */
    protected $global;

    public function __construct(
        int $id,
        string $title,
        int $cityId,
        bool $isGlobal
    )
    {
        $this->setId($id);
        $this->setTitle($title);
        $this->setCityId($cityId);
        $this->setGlobal($isGlobal);
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
     * @return $this
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return void
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
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
    public function setCityId(int $cityId)
    {
        $this->cityId = $cityId;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isGlobal()
    {
        return $this->global;
    }

    /**
     * @param boolean $global
     * @return $this
     */
    public function setGlobal(bool $global)
    {
        $this->global = $global;

        return $this;
    }
}
