<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method\Dictionary;

use App\Hotelbook\ResultProceeder;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;
use App\Hotelbook\Method\Resort;

class ResortTest extends TestCase
{
    public function testHowResortMethodBuildsRequest()
    {
        $mock = new Resort(new ConnectorStub());
        $params = [1];
        $this->assertNotEmpty($mock->build($params), $params);
    }

    public function testHowResortMethodHandlesRequest()
    {
        $mock = $this->getMockBuilder(Resort::class)
            ->setConstructorArgs([new ConnectorStub('resort')])
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
