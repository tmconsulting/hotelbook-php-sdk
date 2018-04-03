<?php

declare(strict_types=1);

namespace Hotelbook\Method;

use Hotelbook\Method\Builder\SearchOrder as Builder;
use Hotelbook\Method\Former\SearchOrder as Former;

/**
 * Class SearchOrder
 * @package Hotelbook\Method
 */
class SearchOrder extends AbstractMethod
{
    /**
     * @param $params
     * @return MealResponse
     */
    public function handle($xml)
    {
        $response = $this->connector->request('POST', 'order_list', $xml);
        return $this->getResultObject($response);
    }

    /**
     * @return mixed|string
     */
    protected function getBuilderClass()
    {
        return Builder::class;
    }

    /**
     * @return string
     */
    protected function getFormerClass()
    {
        return Former::class;
    }
}
