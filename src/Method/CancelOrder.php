<?php

declare(strict_types=1);

namespace App\Hotelbook\Method;

use App\Hotelbook\Method\Builder\BaseBuilder;
use App\Hotelbook\Method\Former\Order as OrderFormer;

/**
 * The class for method to Annul the order (afrer confirm)
 * Class CancelOrder
 * @package App\Hotelbook\Method\Dynamic
 */
class CancelOrder extends AbstractMethod
{
    /**
     * @param $params
     * @return mixed
     */
    public function handle($params)
    {
        [$orderId, $itemId] = $params;
        $this->makeRequest('cancellation_order', $orderId, $itemId);
        return $this->getResultObject($this->proceedChange($params));
    }

    /**
     * @param $method
     * @param $itemId
     * @param $orderId
     * @return \SimpleXMLElement
     */
    protected function makeRequest($method, $itemId, $orderId)
    {
        return $this->connector->request(
            'GET',
            $method,
            null,
            [
                'query' => [
                    'item_id' => $itemId,
                    'order_id' => $orderId
                ]
            ]
        );
    }

    /**
     * @param $params
     * @return \SimpleXMLElement
     */
    protected function proceedChange($params)
    {
        [$orderId, $itemId] = $params;
        return $this->makeRequest('confirm_order', $orderId, $itemId);
    }

    /**
     * @return string
     */
    protected function getBuilderClass()
    {
        return BaseBuilder::class;
    }

    /**
     * @return string
     */
    protected function getFormerClass()
    {
        return OrderFormer::class;
    }

}
