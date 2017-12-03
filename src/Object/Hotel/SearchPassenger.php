<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 13.05.16
 * Project: provider
 */

declare(strict_types=1);

namespace App\Hotelbook\Object\Hotel;

use App\Hotelbook\Object\Pax;

/**
 * Class Pax
 *
 * @package Hive\Common\Object\Hotel
 */
class SearchPassenger
{
    use Pax;

    /**
     * Pax constructor.
     *
     * @param int $adults
     * @param array $childrens
     * @param int $infants
     */
    public function __construct($adults = 1, array $childrens = [], $infants = 0)
    {
        $this->setAdults($adults);
        $this->setChildrens($childrens);
        $this->setInfants($infants);
    }
}
