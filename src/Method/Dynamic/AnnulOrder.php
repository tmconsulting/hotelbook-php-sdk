<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\Dynamic;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Connector\Former\OrderFormer;
use App\Hotelbook\Object\Results\AnnulOrderResult;
use App\Hotelbook\Method\AbstractMethod;

class AnnulOrder extends AbstractMethod
{
    private $connector;
    private $former;

    public function __construct(ConnectorInterface $connector)
    {
        $this->connector = $connector;
        $this->former = new OrderFormer();
    }

    public function build($params)
    {
        return $params;
    }

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
        [$values, $errors] = $this->performResult($result);
        return new AnnulOrderResult($values, $errors);
    }

    public function form($response)
    {
        return $this->former->form($response);
    }
}
