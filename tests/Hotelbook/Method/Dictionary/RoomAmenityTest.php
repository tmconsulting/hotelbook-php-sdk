<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method\Dictionary;

use App\Hotelbook\Method\Dictionary\RoomAmenity as RoomAmenityMethod;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;
use App\Hotelbook\Results\Dictionary\RoomAmenityResponse;
use App\Hotelbook\Object\Hotel\Room\Amenity;

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

        $this->assertInstanceOf(RoomAmenityResponse::class, $response);
        $this->assertInstanceOf(Amenity::class, current($response->getItems()));
    }
}
