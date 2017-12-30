<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method\Dictionary;

use Hotelbook\Method\RoomAmenity as RoomAmenityMethod;
use Hotelbook\ResultProceeder;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;

class RoomAmenityTest extends TestCase
{
    public function testHowRoomAmenityMethodBuildsRequest()
    {
        $mock = new RoomAmenityMethod(new ConnectorStub());
        $params = [123, 123];
        $this->assertEquals($mock->build($params), $params);
    }

    public function testHowRoomAmenityMethodHandlesRequest()
    {
        $mock = $this->getMockBuilder(RoomAmenityMethod::class)
            ->setConstructorArgs([new ConnectorStub('room-amenity')])
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
