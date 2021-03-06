<?php

declare(strict_types=1);

namespace Hotelbook\Method;

use Hotelbook\Method\Builder\BaseBuilder;
use Hotelbook\Method\Former\Order as OrderFormer;

/**
 * The class for method to Annul the order (before confirm)
 * Class AnnulOrder
 * @package App\Hotelbook\Method\Dynamic
 */
class AnnulOrder extends AbstractMethod
{
    /**
     * @param $params
     * @return mixed
     */
    public function handle($params)
    {
        [$orderId, $itemId] = $params;

        $result = $this->connector->request(
            'GET',
            'cancellation_order',
            null,
            [
                'query' => [
                    'item_id' => $itemId,
                    'order_id' => $orderId
                ]
            ]
        );

        return $this->getResultObject($result);
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
