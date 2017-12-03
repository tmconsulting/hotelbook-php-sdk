<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method\Dictionary;

use App\Hotelbook\Method\Dictionary\HotelType as HotelTypeMethod;
use App\Hotelbook\Object\Hotel\Type as HotelTypeObject;
use App\Hotelbook\Results\Dictionary\HotelTypeResponse;
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

        $this->assertInstanceOf(HotelTypeResponse::class, $response);
        $this->assertInstanceOf(HotelTypeObject::class, current($response->getItems()));
    }
}
