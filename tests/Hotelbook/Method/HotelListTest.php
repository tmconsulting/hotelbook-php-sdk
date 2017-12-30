<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method\Dictionary;

use Hotelbook\Method\HotelList;
use Hotelbook\ResultProceeder;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;

class HotelListTest extends TestCase
{
    public function testHowHotelListMethodBuildsRequest()
    {
        $mock = new HotelList(new ConnectorStub());

        $this->assertNotEmpty($mock->build([1, 2]));
    }

    public function testHowHotelListMethodHandlesRequest()
    {
        $mock = $this->getMockBuilder(HotelList::class)
            ->setConstructorArgs([new ConnectorStub('hotel-list')])
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
