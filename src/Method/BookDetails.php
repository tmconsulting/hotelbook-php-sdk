<?php

declare(strict_types=1);

namespace Hotelbook\Method;

use Hotelbook\ResultProceeder;
use Hotelbook\Method\Builder\BaseBuilder;
use Money\Parser\StringToUnitsParser;
use Hotelbook\Method\Former\BookDetails as BookDetailsFormer;

class BookDetails extends AbstractMethod
{
    public function handle($params)
    {
        [ $orderId ] = $params;

        $response = $this->connector->request('GET', 'order_info', null, [
            'query' => [
                'order_id' => $orderId
            ]
        ]);

        return $this->getResultObject($response, null, ResultProceeder::class, false);
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
        return BookDetailsFormer::class;
    }
}
