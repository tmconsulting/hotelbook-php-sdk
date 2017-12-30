<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 01.06.16
 * Project: provider
 */

declare(strict_types=1);

namespace Hotelbook\Object\Hotel\Search;

/**
 * Class Tariff
 *
 * @package Hive\Common\Object\Hotel\SearchResult
 */
class Tariff
{
    /**
     * Наименование тарифа.
     *
     * Обязательный параметр.
     *
     * @var string
     */
    protected $name;

    /**
     * Описание тарифа.
     *
     * Необязательный параметр.
     *
     * @var string
     */
    protected $description;

    /**
     * Tariff constructor.
     *
     * @param $name
     * @param $description
     */
    public function __construct($name, $description = null)
    {
        $this->setName($name);
        $this->setDescription($description);
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
     * @return Tariff
     */
    public function setName(string $name)
    {
        $this->name = $name;

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
     * @return Tariff
     */
    public function setDescription(?string $description)
    {
        $this->description = $description;

        return $this;
    }
}
