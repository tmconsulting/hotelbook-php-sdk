<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method\Dictionary;

use App\Hotelbook\Method\HotelFacility;
use App\Hotelbook\Method\HotelCategory;
use App\Hotelbook\ResultProceeder;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;

class HotelFacilityTest extends TestCase
{
    public function testHowHotelFacilityMethodBuildsRequest()
    {
        $mock = new HotelFacility(new ConnectorStub());
        $params = [1, 2];

        $this->assertEquals($params, $mock->build($params));
    }

    public function testHowCountryMethodHandlesRequest()
    {
        $mock = $this->getMockBuilder(HotelFacility::class)
            ->setConstructorArgs([new ConnectorStub('hotel-facility')])
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
