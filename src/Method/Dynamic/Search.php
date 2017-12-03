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
use App\Hotelbook\Method\Builder\Dynamic\Search as SearchBuilder;
use App\Hotelbook\Method\Former\Dynamic\Search as SearchFormer;
use App\Hotelbook\Results\Method\SearchResult;

class Search extends AbstractMethod
{
    const DATE_FORMAT = 'Y-m-d';

    /**
     * @var SearchFormer
     */
    private $former;

    /**
     * @var SearchBuilder
     */
    private $builder;

    /**
     * SearchResult constructor.
     * @param \App\Hotelbook\Connector\ConnectorInterface $connector
     */
    public function __construct(ConnectorInterface $connector)
    {
        parent::__construct($connector);
        $this->former = new SearchFormer();
        $this->builder = new SearchBuilder();
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
     * @return string
     */
    public function getResultClass()
    {
        return SearchResult::class;
    }

    /**
     * @param $results <- builds results
     * @return mixed
     */
    public function handle($results)
    {
        $response = $this->connector->request('POST', 'hotel_search', $results);
        return $this->getResultObject($response);
    }


    /**
     * Метод для формирования ответа из ответа XML
     * @param $response
     * @return array
     */
    protected function form($response)
    {
        return $this->former->form($response);
    }
}
