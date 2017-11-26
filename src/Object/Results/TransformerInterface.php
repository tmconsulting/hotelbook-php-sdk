<?php

declare(strict_types=1);

namespace App\Hotelbook\Object\Results;

interface TransformerInterface
{
    /**
     * An interface for all the items transformation layer.
     * @param array $items
     * @return array
     */
    public function transform(array $items);
}