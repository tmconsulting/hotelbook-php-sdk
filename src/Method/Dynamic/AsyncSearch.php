<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 22.05.16
 * Project: provider_hotelbook
 */

declare(strict_types=1);

namespace App\Hotelbook\Method\Dynamic;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Method\Builder\Dynamic\BuilderInterface;
use App\Hotelbook\Method\Builder\Dynamic\Search as SearchBuilder;
use App\Hotelbook\Object\Method\Search\AsyncSearch as AsyncSearchObject;

/**
 * A method that implements the async search functionality.
 * Class AsyncSearch
 * @package App\Hotelbook\Method\Dynamic
 */
class AsyncSearch extends AbstractMethod
{
    /**
     * @var BuilderInterface
     */
    private $builder;

    /**
     * SearchResult constructor.
     *
     * @param \App\Hotelbook\Connector\ConnectorInterface $connector
     */
    public function __construct(ConnectorInterface $connector)
    {
        parent::__construct($connector);
        $this->builder = new SearchBuilder();
    }

    /**
     * @param $params
     * @return mixed
     */
    public function build($params)
    {
        [$buildParams, $searchParams] = $params;
        return [$this->builder->build($buildParams), $searchParams];
    }

    /**
     * @param $params
     * @return AsyncSearchObject|null
     */
    public function handle($params)
    {
        [$xml, $searchParams] = $params;
        $response = $this->connector->request('POST', 'hotel_search', $xml, [
            'query' => [
                'async' => 1,
                'timeout' => $searchParams->getTimeout()
            ]
        ]);

        $errors = $this->getErrors($response);

        if (empty($errors)) {
            return $this->getResultObject(null, $this->form([$response, $searchParams]));
        }

        return null;
    }

    /**
     * @return string
     */
    protected function getResultClass()
    {
        return AsyncSearchObject::class;
    }

    /**
     * @param $data
     * @return AsyncSearchObject
     */
    protected function form($data)
    {
        [$response, $searchParams] = $data;

        $searchParams->setSearchId((int)$response->HotelSearchId);

        return [$this->connector, $searchParams];
    }
}
