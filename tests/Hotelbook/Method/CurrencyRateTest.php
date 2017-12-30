<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method\Dictionary;

use Hotelbook\Method\CurrencyRate;
use Hotelbook\ResultProceeder;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;

class CurrencyRateTest extends TestCase
{
    public function testHowCurrencyRateMethodBuildsRequest()
    {
        $mock = new CurrencyRate(new ConnectorStub());
        $params = [1, 2];
        $this->assertEquals($mock->build($params), $params);
    }

    public function testHowResortMethodHandlesRequest()
    {
        $mock = $this->getMockBuilder(CurrencyRate::class)
            ->setConstructorArgs([new ConnectorStub('currency-rate')])
            ->setMethods(['getErrors'])
            ->getMock();

        $mock->expects($this->once())
            ->method('getErrors')
            ->willReturn([]);

        $response = $mock->handle([]);

        $this->assertInstanceOf(ResultProceeder::class, $response);
        $this->assertNotEmpty($response->getItems());
    }
}
