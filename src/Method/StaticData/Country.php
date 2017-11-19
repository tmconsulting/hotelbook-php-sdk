<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\StaticData;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Object\Results\StaticData\CountryResponse;

class Country extends AbstractMethod
{
    private $connector;

    public function __construct(ConnectorInterface $connector)
    {
        $this->connector = $connector;
    }

    public function build($params)
    {
        return $params;
    }

    public function handle($params)
    {
        $result = $this->connector->request('GET', 'countries');
        $errors = $this->getErrors($result);

        if (!empty($errors)) {
            return new CountryResponse([], $errors);
        }

        return new CountryResponse($this->form($result), $errors);
    }

    public function form($response)
    {
        $items = [];

        foreach ($response->Countries->Country as $country) {
            $items[] = [
                'id' => (string)$country->attributes()['id'],
                'name' => (string) $country
            ];
        }

        return $items;
    }
}
