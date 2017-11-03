<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 02.06.16
 * Project: provider
 */

declare(strict_types=1);

namespace App\Hotelbook\Object;

/**
 * Trait Pax
 *
 * @package Hive\Common\Object
 */
trait Pax
{
    /**
     * Кол-во взрослых
     *
     * Обязательный параметр.
     *
     * @var int
     */
    protected $adults;

    /**
     * Количество младенцев.
     *
     * @var int
     */
    protected $infants;

    /**
     * Количество детей и их возраст.
     *
     * Пример. [7, 11] - двое детей с возрастом 7 и 11 лет.
     *
     * @var array
     */
    protected $childrens;

    /**
     * @param bool $infant
     * @return int
     */
    public function getCountOfGuests($infant = false)
    {
        $count = $this->getCountOfChildrens() + $this->getAdults();

        return $infant ? $count + $this->getInfants() : $count;
    }

    /**
     * @return int
     */
    public function getCountOfChildrens()
    {
        return count($this->getChildrens());
    }

    /**
     * @return array
     */
    public function getChildrens()
    {
        return $this->childrens;
    }

    /**
     * @param array $childrens
     * @return $this
     */
    public function setChildrens(array $childrens)
    {
        $this->childrens = $childrens;

        return $this;
    }

    /**
     * @return int
     */
    public function getAdults()
    {
        return $this->adults;
    }

    /**
     * @param int $adults
     * @return $this
     */
    public function setAdults(int $adults)
    {
        $this->adults = $adults;

        return $this;
    }

    /**
     * @return int
     */
    public function getInfants()
    {
        return $this->infants;
    }

    /**
     * @param int $infants
     * @return $this
     */
    public function setInfants(int $infants)
    {
        $this->infants = $infants;

        return $this;
    }
}
