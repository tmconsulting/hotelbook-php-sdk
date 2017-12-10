<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Project: provider
 */

declare(strict_types=1);

namespace App\Hotelbook\Object\Hotel\Room;

/**
 * Class Size
 *
 * @package Hive\Common\Object\Hotel\Room
 */
class Size
{
    /**
     * @var int
     */
    protected $id;
    /**
     * Сокращенное название размера (SGL, DBL, DBL-SOLO и т.д.)
     *
     * @var string
     */
    protected $shortName;
    /**
     * Полное название номера
     *
     * @var string
     */
    protected $fullName;
    /**
     * Количество взрослых в номере
     *
     * @var int
     */
    protected $pax;
    /**
     * Наличие дополнительного места для ребенка
     *
     * @var bool
     */
    protected $children;
    /**
     * Количество люлек в номере
     *
     * @var int
     */
    protected $cots;
    /**
     * Возможно ли данный размер номера задать в параметрах поиска отеля
     *
     * @var bool
     */
    protected $searchable;

    /**
     * Size constructor.
     * @param int $id
     * @param string $shortName
     * @param string $fullName
     * @param int $pax
     * @param bool $children
     * @param int $cots
     * @param bool $searchable
     */
    public function __construct(
        int $id,
        string $shortName,
        string $fullName,
        int $pax,
        bool $children,
        int $cots,
        bool $searchable
    )
    {
        $this->setId($id);
        $this->setShortName($shortName);
        $this->setShortName($fullName);
        $this->setPax($pax);
        $this->setChildren($children);
        $this->setCots($cots);
        $this->setSearchable($searchable);
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
     * @return string
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * @param string $shortName
     */
    public function setShortName(string $shortName)
    {
        $this->shortName = $shortName;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName(string $fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return int
     */
    public function getPax()
    {
        return $this->pax;
    }

    /**
     * @param int $pax
     */
    public function setPax(int $pax)
    {
        $this->pax = $pax;
    }

    /**
     * @return boolean
     */
    public function isChildren()
    {
        return $this->children;
    }

    /**
     * @param boolean $children
     */
    public function setChildren(bool $children)
    {
        $this->children = $children;
    }

    /**
     * @return int
     */
    public function getCots()
    {
        return $this->cots;
    }

    /**
     * @param int $cots
     */
    public function setCots(int $cots)
    {
        $this->cots = $cots;
    }

    /**
     * @return boolean
     */
    public function isSearchable()
    {
        return $this->searchable;
    }

    /**
     * @param boolean $searchable
     */
    public function setSearchable(bool $searchable)
    {
        $this->searchable = $searchable;
    }
}
