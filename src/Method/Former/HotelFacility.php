<?php

namespace Hotelbook\Method\Former;

/**
 * Class HotelFacility
 * @package App\Hotelbook\Method\Former
 */
class HotelFacility extends BaseFormer
{
    /**
     * @param $response
     * @return array
     */
    public function form($response)
    {
        $result = [];

        foreach ($response->HotelFacilities->Facility as $facility) {
            $result[] = [
                'id' => (int)$facility->attributes()['id'],
                'name' => (string)$facility
            ];
        }

        return $result;
    }
}