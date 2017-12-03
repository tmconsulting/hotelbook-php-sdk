<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\Dynamic;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Method\Former\Dynamic\BaseFormer;
use App\Hotelbook\Method\Former\Dynamic\FormerInterface;
use App\Hotelbook\Method\Former\Dynamic\Order;
use App\Hotelbook\Results\Method\ConfirmOrderResult;

/**
 * An method implementation of Confirming order (after book)
 * Class ConfirmOrder
 * @package App\Hotelbook\Method\Dynamic
 */
class ConfirmOrder extends AbstractMethod
{
    /**
     * @var BaseFormer
     */
    protected $former;

    /**
     * ConfirmOrder constructor.
     * @param ConnectorInterface $connector
     */
    public function __construct(ConnectorInterface $connector)
    {
        parent::__construct($connector);
        $this->former = new Order();
    }

    /**
     * @param $params
     * @return mixed
     */
    public function build($params)
    {
        return $params;
    }

    /**
     * @param $params
     * @return ConfirmOrderResult
     */
    public function handle($params)
    {
        [$orderId, $itemId, $price, $currency] = $params;
        $result = $this->connector->request(
            'GET',
            'confirm_order',
            null,
            [
                'query' => [
                    'item_id' => $itemId,
                    'order_id' => $orderId,
                    'total_price' => $price,
                    'currency' => $currency
                ]
            ]
        );

        return $this->getResultObject($result);
    }

    /**
     * @return string
     */
    protected function getResultClass()
    {
        return ConfirmOrderResult::class;
    }

    /**
     * @param $response
     * @return array|mixed
     */
    protected function form($response)
    {
        return $this->former->form($response);
    }
}
