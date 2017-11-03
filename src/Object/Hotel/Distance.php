<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 22.05.16
 * Project: provider
 */

declare(strict_types=1);

namespace App\Hotelbook\Object\Hotel;

/**
 * Trait Distance
 *
 * @package Hive\Common\Object\Hotel\SearchResult
 */
trait Distance
{
    /**
     * @var string
     */
    protected $type;

    /**
     * Наименование объекта.
     * Не указывается, если $type == self::CENTER.
     *
     * @var string
     */
    protected $name;

    /**
     * Расстояние до объекта **в метрах**.
     *
     * @var int
     */
    protected $unit;

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param int $unit
     * @return $this
     */
    public function setUnit(int $unit)
    {
        $this->unit = $unit;

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
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }
}