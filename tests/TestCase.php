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

    /**
     * A function to format xml in the tests
     * @param string $xml
     * @return string $xml
     */
    protected function formatXml(string $xml)
    {
        $dom = new \DOMDocument("1.0");
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xml);
        return $dom->saveXML();
    }
}
