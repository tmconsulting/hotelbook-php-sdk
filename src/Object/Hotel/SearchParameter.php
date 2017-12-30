<?php

namespace Hotelbook\Object\Hotel;

/**
 * Class SearchParameter
 *
 * @package Hive\Common\Object\Hotel
 */
class SearchParameter
{
    /**
     * @var string $hotelName
     */
    private $hotelName = null;

    /**
     * @return string
     */
    public function getHotelName()
    {
        return $this->hotelName;
    }

    /**
     * @param string $hotelNam
     */
    public function setHotelName($hotelName)
    {
        $this->hotelName = $hotelName;
    }

}
