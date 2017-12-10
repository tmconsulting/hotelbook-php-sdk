<?php

declare(strict_types=1);

namespace App\Hotelbook\Method;

use App\Hotelbook\Method\Builder\Search as SearchBuilder;
use App\Hotelbook\Method\Former\Search as SearchFormer;

class Search extends AbstractMethod
{
    const DATE_FORMAT = 'Y-m-d';

    /**
     * @param $results <- builds results
     * @return mixed
     */
    public function handle($results)
    {
        $response = $this->connector->request('POST', 'hotel_search', $results);
        return $this->getResultObject($response);
    }

    protected function getBuilderClass()
    {
        return SearchBuilder::class;
    }

    protected function getFormerClass()
    {
        return SearchFormer::class;
    }
}
