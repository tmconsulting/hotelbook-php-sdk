<?php

namespace App\Hotelbook\Method;

use SimpleXMLElement;
use App\Hotelbook\Object\Hotel\Price;

/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 10/23/17
 */
abstract class AbstractMethod implements MethodInterface
{
    /**
     * @param SimpleXMLElement $element
     * @return array
     */
    protected function getErrors(\SimpleXMLElement $element)
    {
        $errors = [];
        if (isset($element->Errors)) {
            foreach ($element->Errors->Error as $err) {
                $err = current($err);
                $errors[] = [
                    'id' => (string)$err['code'],
                    'desc' => (string)$err['description'],
                ];
            }
        }

        return $errors;
    }

    /**
     * @param $sum
     * @param $currency
     * @return Money
     */
    protected function money($sum, $currency)
    {
        return new Price($sum, $currency);
    }
}
