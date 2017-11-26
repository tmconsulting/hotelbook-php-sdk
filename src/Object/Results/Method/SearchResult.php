<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 22.05.16
 * Project: provider
 */

declare(strict_types=1);

namespace App\Hotelbook\Object\Results\Method;

//TODO Array -> Objects

use App\Hotelbook\Object\Results\ResultProceeder;

/**
 * Class SearchResult
 *
 * @package Hive\Common\Object
 */
class SearchResult extends ResultProceeder
{
    /**
     * @var array
     */
    protected $params;

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param array $params
     * @return $this
     */
    public function setParams(array $params)
    {
        $this->params = $params;

        return $this;
    }
}
