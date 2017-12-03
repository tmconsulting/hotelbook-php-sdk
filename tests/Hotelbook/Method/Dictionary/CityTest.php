<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method\Dictionary;

use App\Hotelbook\Method\Dictionary\City;
use App\Hotelbook\Object\Hotel\Dictionary\City as CityModel;
use App\Hotelbook\Object\Hotel\Dictionary\Country;
use App\Hotelbook\Results\Dictionary\CityResponse;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;

class CityTest extends TestCase
{
    public function testHowCityMethodBuildsRequestNull()
    {
        $mock = new City(new ConnectorStub());
        $params = [null];
        $this->assertEquals($mock->build($params), []);
    }

    public function testHowCityMethodBuildsRequestIfNotNull()
    {
        $mock = new City(new ConnectorStub());
        $params = [new Country(1, 'Some country')];

        $expected = [
            'query' => [
                'country_id' => 1
            ]
        ];

        $this->assertEquals($mock->build($params), $expected);
    }

    public function testHowCityMethodHandlesRequest()
    {
        $mock = $this->getMockBuilder(City::class)
            ->setConstructorArgs([new ConnectorStub('city')])
            ->setMethods(['getErrors'])
            ->getMock();

        $mock->expects($this->once())
            ->method('getErrors')
            ->willReturn([]);

        $response = $mock->handle([]);

        $this->assertInstanceOf(CityResponse::class, $response);
        $this->assertInstanceOf(CityModel::class, current($response->getItems()));
    }
}
