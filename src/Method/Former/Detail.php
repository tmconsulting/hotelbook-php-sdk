<?php

declare(strict_types=1);

namespace Hotelbook\Method\Former;

/**
 * Class Detail former
 * @package App\Hotelbook\Method\Former
 */
class Detail extends BaseFormer
{
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
            'numberFloors' => (int)$detail->NumberFloors,
            'conference' => (string)$detail->Conference,
            'voltage' => (string)$detail->Voltage,
            'childAgeFrom' => (string)$detail->ChildAgeFrom,
            'childAgeTo' => (string)$detail->ChildAgeTo,
            'earlestCheckInTime' => isset($detail->EarlestCheckInTime) ? (string)$detail->EarlestCheckInTime : null,
            'latestCheckOutTime' => isset($detail->LatestCheckOutTime) ? (string)$detail->LatestCheckOutTime : null,
            'description' => (string)$detail->Description,
            'distances' => (string)$detail->Distances,
            'porterage24' => (string)$detail->Porterage24h === 'YES',
            'service24' => (string)$detail->RoomService24h === 'YES',
            'indoorPool' => (int)$detail->IndoorPool,
            'outdoorPool' => (int)$detail->OutdoorPool,
            'childrensPool' => (int)$detail->ChildrensPool,
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
