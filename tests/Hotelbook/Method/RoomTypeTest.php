<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method\Dictionary;

use App\Hotelbook\Method\RoomType as RoomTypeMethod;
use App\Hotelbook\ResultProceeder;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;

class RoomTypeTest extends TestCase
{
    public function testHowRoomTypeMethodBuildsRequest()
    {
        $mock = new RoomTypeMethod(new ConnectorStub());
        $params = [123, 123];
        $this->assertEquals($mock->build($params), $params);
    }

    public function testHowRoomTypeMethodHandlesRequest()
    {
        $mock = $this->getMockBuilder(RoomTypeMethod::class)
            ->setConstructorArgs([new ConnectorStub('room-type')])
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
