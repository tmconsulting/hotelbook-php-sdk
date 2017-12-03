<?php

namespace App\Hotelbook\Results;

//TODO Delete this transformer and write a transformer for each result object.
class DefaultTransformer implements TransformerInterface
{
    /**
     * @param array $items
     * @return array
     */
    public function transform(array $items)
    {
        return $items;
    }
}
