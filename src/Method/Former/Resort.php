<?php

namespace App\Hotelbook\Method\Former;

class Resort extends BaseFormer
{
    public function form($response)
    {
        $result = [];

        foreach ($response->Resorts->Resort as $resort)
        {
            $result[] = [
                'id' => (int) $resort->attributes()['id'],
                'country' => (int) $resort->attributes()['country'],
                'title' => (string) $resort
            ];
        }

        return $result;
    }
}