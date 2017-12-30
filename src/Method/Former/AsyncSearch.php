<?php

namespace Hotelbook\Method\Former;

class AsyncSearch extends BaseFormer
{
    public function form($data)
    {
        [$response, $searchParams, $connector] = $data;
        $searchParams->setSearchId((int)$response->HotelSearchId);
        return [$connector, $searchParams, $response->HotelSearchRequest];
    }
}