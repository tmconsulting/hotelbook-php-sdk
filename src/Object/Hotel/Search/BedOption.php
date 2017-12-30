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
 * Class BedOption
 * Доп. кол-во кроватей, которые можно поставить в номере.
 *
 * @package Hive\Common\Object\Hotel\SearchResult
 */
class BedOption
{
    /**
     * @var int
     */
    protected $adult;

    /**
     * @var int
     */
    protected $child;

    /**
     * @var int
     */
    protected $infant;

    /**
     * @return int
     */
    public function getAdult()
    {
        return $this->adult;
    }

    /**
     * @param int $adult
     * @return $this
     */
    public function setAdult(int $adult)
    {
        $this->adult = $adult;

        return $this;
    }

    /**
     * @return int
     */
    public function getChild()
    {
        return $this->child;
    }

    /**
     * @param int $child
     * @return $this
     */
    public function setChild(int $child)
    {
        $this->child = $child;

        return $this;
    }

    /**
     * @return int
     */
    public function getInfant()
    {
        return $this->infant;
    }

    /**
     * @param int $infant
     * @return $this
     */
    public function setInfant(int $infant)
    {
        $this->infant = $infant;

        return $this;
    }
}
