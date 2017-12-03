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
     * Count of adults
     *
     * Required field
     *
     * @var int
     */
    protected $adults;

    /**
     * Count of infants
     *
     * @var int
     */
    protected $infants;

    /**
     * Number of childs and their age
     *
     * Example. [7, 11] - two children with age 7 and 11 years olf.
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
