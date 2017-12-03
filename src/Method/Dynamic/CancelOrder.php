<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\Dynamic;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Method\Builder\BaseBuilder;
use App\Hotelbook\Method\Former\Dynamic\BaseFormer;
use App\Hotelbook\Method\Former\Dynamic\Order;
use App\Hotelbook\Results\Method\CancelOrderResult;

/**
 * The class for method to Annul the order (afrer confirm)
 * Class CancelOrder
 * @package App\Hotelbook\Method\Dynamic
 */
class CancelOrder extends AbstractMethod
{
    /**
     * @var BaseBuilder
     */
    protected $builder;

    /**
     * @var BaseFormer
     */
    protected $former;

    /**
     * CancelOrder constructor.
     * @param ConnectorInterface $connector
     */
    public function __construct(ConnectorInterface $connector)
    {
        parent::__construct($connector);

        $this->former = new Order();
        $this->builder = new BaseBuilder();
    }

    /**
     * @param $params
     * @return mixed
     */
    public function build($params)
    {
        return $this->builder->build($params);
    }

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
     * @return string
     */
    protected function getResultClass()
    {
        return CancelOrderResult::class;
    }

    /**
     * @param $response
     * @return array|mixed
     */
    protected function form($response)
    {
        return $this->former->form($response);
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
}
