<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method\Dictionary;

use App\Hotelbook\Method\Country;
use App\Hotelbook\Object\Hotel\Dictionary\Country as CountryModel;
use App\Hotelbook\ResultProceeder;
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

        $this->assertInstanceOf(ResultProceeder::class, $response);
        $this->assertNotEmpty($response->getItems());
    }
}
