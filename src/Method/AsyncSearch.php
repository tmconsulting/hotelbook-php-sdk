<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 22.05.16
 * Project: provider_hotelbook
 */

declare(strict_types=1);

namespace App\Hotelbook\Method;

use App\Hotelbook\Method\Builder\Search as SearchBuilder;
use App\Hotelbook\Method\Former\AsyncSearch as AsyncSearchFormer;
use App\Hotelbook\Object\Method\Search\AsyncSearch as AsyncSearchObject;

/**
 * A method that implements the async search functionality.
 * Class AsyncSearch
 * @package App\Hotelbook\Method\Dynamic
 */
class AsyncSearch extends AbstractMethod
{
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
            return $this->getResultObject(null, $this->form([$response, $searchParams, $this->connector]), AsyncSearchObject::class);
        }

        return null;
    }

    protected function getBuilderClass()
    {
        return SearchBuilder::class;
    }

    protected function getFormerClass()
    {
        return AsyncSearchFormer::class;
    }
}
