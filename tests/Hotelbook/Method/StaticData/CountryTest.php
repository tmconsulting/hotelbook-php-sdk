<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method\StaticData;

use App\Hotelbook\Method\StaticData\Country;
use App\Hotelbook\Object\Hotel\Dictionary\Country as CountryModel;
use App\Hotelbook\Object\Results\StaticData\CountryResponse;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;

class CountryTest extends TestCase
{
    public function testHowCountryMethodBuildsRequest()
    {
        $mock = new Country(new ConnectorStub());
        $params = [123, 123];
        $this->assertEquals($mock->build($params), $params);
    }

    public function testHowCountryMethodHandlesRequest()
    {
        $mock = $this->getMockBuilder(Country::class)
            ->setConstructorArgs([new ConnectorStub('country')])
            ->setMethods(['getErrors'])
            ->getMock();

        $mock->expects($this->once())
            ->method('getErrors')
            ->willReturn([]);

        $response = $mock->handle([]);

        $this->assertInstanceOf(CountryResponse::class, $response);
        $this->assertInstanceOf(CountryModel::class, current($response->getItems()));
    }
}
