<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method\Dictionary;

use App\Hotelbook\Method\HotelCategory;
use App\Hotelbook\ResultProceeder;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;

class HotelCategoryTest extends TestCase
{
    public function testHowHotelCategoryMethodBuildsRequest()
    {
        $mock = new HotelCategory(new ConnectorStub());
        $params = [1, 2];

        $this->assertEquals($params, $mock->build($params));
    }

    public function testHowHotelCategoryMethodHandlesRequest()
    {
        $mock = $this->getMockBuilder(HotelCategory::class)
            ->setConstructorArgs([new ConnectorStub('hotel-category')])
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
