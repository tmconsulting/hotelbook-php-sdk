<?php

namespace Neo\Hotelbook\Tests;

/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */
class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @param $name
     * @return bool|string
     */
    protected function getRequestProtocol(string $name)
    {
        return file_get_contents(__DIR__ . "/protocol/request/{$name}.xml");
    }
}
