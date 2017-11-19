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
use App\Hotelbook\Object\Results\DetailResult;
use Money\Parser\StringToUnitsParser;
use App\Hotelbook\Method\AbstractMethod;

class Detail extends AbstractMethod
{
    /**
     * @var \App\Hotelbook\Connector\ConnectorInterface
     */
    private $connector;

    /**
     * SearchResult constructor.
     *
     * @param \App\Hotelbook\Connector\ConnectorInterface $connector
     */
    public function __construct(ConnectorInterface $connector)
    {
        $this->connector = $connector;
    }

    /**
     * http://xmldoc.hotelbook.pro/html/ru/hotels/hotel-detail.html
     * @param $params
     * @return mixed
     */
    public function build($params)
    {
        return $params;
    }

    /**
     * @param $results <- builds results
     * @return mixed
     */
    public function handle($results)
    {
        [$value, $byName] = $results;

        $optionKey = $byName ? 'hotel_name' : 'hotel_id';
        $results = $this->connector->request('GET', 'hotel_detail', null, [
            'query' => [$optionKey => $value]
        ]);

        $errors = $this->getErrors($results);
        $values = [];

        if (empty($errors)) {
            $values = $this->form($results);
        }

        return new DetailResult($values, $errors);
    }

    /**
     * @param $results
     * @return array
     */
    public function form($results)
    {
        $attributes = current($results->HotelDetail);
        $detail = $results->HotelDetail;

        $array = [
            'id' => array_get($attributes, 'id'),
            'name' => array_get($attributes, 'name'),
            'stars' => (int)$detail->Cat,
            'country' => [
                'id' => (int)$detail->Country->attributes()['id'],
                'name' => (string)$detail->Country,
            ],
            'city' => [
                'id' => (int)$detail->City->attributes()['id'],
                'name' => (string)$detail->City,
            ],
            'address' => (string)$detail->Address,
            'phone' => (string)$detail->Phone,
            'fax' => (string)$detail->Fax,
            'email' => (string)$detail->Email,
            'url' => (string)$detail->WWW,
            'coords' => [
                'lat' => (float)$detail->Latitude,
                'lng' => (float)$detail->Longitude,
            ],
            'builtIn' => (string)$detail->BuiltIn,
            'buildingType' => (string)$detail->BuildingType,
            'numberLifts' => (int)$detail->NumberLifts,
            'conference' => (string)$detail->Conference,
            'voltage' => (string)$detail->Voltage,
            'childAgeFrom' => (string)$detail->ChildAgeFrom,
            'childAgeTo' => (string)$detail->ChildAgeTo,
            'earlestCheckInTime' => isset($detail->EarlestCheckInTime) ? (string)$detail->EarlestCheckInTime : null,
            'latestCheckOutTime' => isset($detail->LatestCheckOutTime) ? (string)$detail->LatestCheckOutTime : null,
            'description' => (string)$detail->Description,
            'distances' => (string)$detail->Distances,
            'gta' => [
                'code' => (string)$detail->GTAHotelCode,
                'city' => (string)$detail->GTACityCode,
                'updated' => (string)$detail->Updated,
            ]
        ];

        foreach ($detail->Images->Image as $item) {
            $array['images'][] = [
                'src' => (string)$item->Large,
                'width' => (int)$item->Large->attributes()['width'],
                'height' => (int)$item->Large->attributes()['height'],
                'description' => (int)$item->Info,
            ];
        }

        return array_merge($array, ...[
            $this->eachTypicalElements($detail, 'Locations.Location', 'locations'),
            $this->eachTypicalElements($detail, 'HotelFacility.Facility', 'facilities'),
            $this->eachTypicalElements($detail, 'RoomAmenity.Amenity', 'amenities'),
            $this->eachTypicalElements($detail, 'HotelType.Type', 'types'),
        ]);
    }

    /**
     * @param $object
     * @param $nested
     * @param $key
     * @return array
     */
    private function eachTypicalElements($object, string $nested, string $key): array
    {
        $array = [];
        foreach (data_get($object, $nested, []) as $item) {
            $array[$key][] = [
                'id' => (int)$item->attributes()['id'],
                'name' => (string)$item,
            ];
        }

        return $array;
    }
}
