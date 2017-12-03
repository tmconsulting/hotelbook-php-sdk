<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\Dynamic;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Method\Former\Dynamic\BaseFormer;
use App\Hotelbook\Method\Former\Dynamic\Order;
use App\Hotelbook\Results\Method\AnnulOrderResult;

/**
 * The class for method to Annul the order (before confirm)
 * Class AnnulOrder
 * @package App\Hotelbook\Method\Dynamic
 */
class AnnulOrder extends AbstractMethod
{
    /**
     * Former to form the result.
     * @var BaseFormer
     */
    private $former;

    /**
     * AnnulOrder constructor.
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
    protected function getResultClass()
    {
        return AnnulOrderResult::class;
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
