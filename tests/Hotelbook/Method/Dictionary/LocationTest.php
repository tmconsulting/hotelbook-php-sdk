<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method\Dictionary;

use App\Hotelbook\Method\Dictionary\Location as LocationMethod;
use App\Hotelbook\Object\Hotel\Dictionary\Location as LocationObject;
use App\Hotelbook\Results\Dictionary\LocationResponse;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;

class LocationTest extends TestCase
{
    public function testHowLocationMethodBuildsRequest()
    {
        $mock = new LocationMethod(new ConnectorStub());
        $params = [123, 123];
        $this->assertEquals($mock->build($params), $params);
    }

    public function testHowLocationMethodHandlesRequest()
    {
        $mock = $this->getMockBuilder(LocationMethod::class)
            ->setConstructorArgs([new ConnectorStub('location')])
            ->setMethods(['getErrors'])
            ->getMock();

        $mock->expects($this->once())
            ->method('getErrors')
            ->willReturn([]);

        $response = $mock->handle([]);

        $this->assertInstanceOf(LocationResponse::class, $response);
        $this->assertInstanceOf(LocationObject::class, current($response->getItems()));
    }
}
