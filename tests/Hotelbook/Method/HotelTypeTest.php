<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method\Dictionary;

use App\Hotelbook\Method\HotelType as HotelTypeMethod;
use App\Hotelbook\Object\Hotel\Type as HotelTypeObject;
use App\Hotelbook\ResultProceeder;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;

class HotelTypeTest extends TestCase
{
    public function testHowHotelTypeMethodBuildsRequest()
    {
        $mock = new HotelTypeMethod(new ConnectorStub());
        $params = [123, 123];
        $this->assertEquals($mock->build($params), $params);
    }

    public function testHowHotelTypeMethodHandlesRequest()
    {
        $mock = $this->getMockBuilder(HotelTypeMethod::class)
            ->setConstructorArgs([new ConnectorStub('hotel-type')])
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
