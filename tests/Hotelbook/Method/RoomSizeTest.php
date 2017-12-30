<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method\Dictionary;

use Hotelbook\Method\RoomSize as RoomSizeMethod;
use Hotelbook\ResultProceeder;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;

class RoomSizeTest extends TestCase
{
    public function testHowRoomSizeMethodBuildsRequest()
    {
        $mock = new RoomSizeMethod(new ConnectorStub());
        $params = [123, 123];
        $this->assertEquals($mock->build($params), $params);
    }

    public function testHowRoomSizeMethodHandlesRequest()
    {
        $mock = $this->getMockBuilder(RoomSizeMethod::class)
            ->setConstructorArgs([new ConnectorStub('room-size')])
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
