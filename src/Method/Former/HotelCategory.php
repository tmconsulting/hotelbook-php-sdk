<?php

namespace Hotelbook\Method\Former;

/**
 * Class HotelCategory
 * @package App\Hotelbook\Method\Former
 */
class HotelCategory extends BaseFormer
{
    /**
     * @param $response
     * @return array
     */
    public function form($response)
    {
        $result = [];

        foreach ($response->HotelCategories->Category as $category) {
            $result[] = [
                'id' => (int)$category->attributes()['id'],
                'name' => (string)$category
            ];
        }

        return $result;
    }
}