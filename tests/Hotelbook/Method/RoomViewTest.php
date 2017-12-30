<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method\Dictionary;

use Hotelbook\Method\RoomView;
use Hotelbook\ResultProceeder;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;

class RoomViewTest extends TestCase
{
    public function testHowRoomViewMethodBuildsRequest()
    {
        $mock = new RoomView(new ConnectorStub());
        $params = [1, 2];

        $this->assertEquals($params, $mock->build($params));
    }

    public function testHowRoomViewMethodHandlesRequest()
    {
        $mock = $this->getMockBuilder(RoomView::class)
            ->setConstructorArgs([new ConnectorStub('room-view')])
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
