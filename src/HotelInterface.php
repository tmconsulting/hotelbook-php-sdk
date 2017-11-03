<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 10/18/17
 */

namespace App\Hotelbook;

/**
 * Class Main
 *
 * @package App\Hotelbook
 */
interface HotelInterface
{
    /**
     * @param int $cityId
     * @param string $checkInDate
     * @param string $checkOutDate
     * @param array $passengers
     * @param array $options
     * @return mixed
     */
    public function search(int $cityId, string $checkInDate, string $checkOutDate, array $passengers, array $options = []);

    /**
     * $value - это ID отеля, пока $byName = false
     * $value - это имя отеля, пока $byName = true
     *
     * @param $value
     * @param bool $byName
     * @return mixed
     */
    public function detail($value, bool $byName = false);

    /**
     * @param $value
     * @param bool $byName
     * @return mixed
     */
    public function book($value, bool $byName = false);
}
