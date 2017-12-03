<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 22.05.16
 * Project: provider
 */

declare(strict_types=1);

namespace App\Hotelbook\Object\Hotel\Search;

use App\Hotelbook\Object\Hotel\Distance;

/**
 * Class Location
 *
 * Список объектов, которые находятся рядом с отелем.
 * В объекте нет идентификаторов, которые предназначены для базы.
 *
 * @package Hive\Common\Object\Hotel\SearchResult
 */
class Location
{
    const SUBWAY = 'subway';
    const CENTER = 'center';
    const AIRPORT = 'airport';
    const RAILWAY = 'railway';

    use Distance;

    /**
     * Distance constructor.
     *
     * @param string $type
     * @param int $unit
     * @param string $name
     */
    public function __construct(string $type, int $unit, string $name = '')
    {
        $this->setType($type);
        $this->setUnit($unit);
        $this->setName($name);
    }
}
